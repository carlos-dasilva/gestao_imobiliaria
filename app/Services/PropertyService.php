<?php

namespace App\Services;

use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyVideo;
use App\Models\PropertyType;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class PropertyService
{
    public function __construct(
        private readonly ImageUploadService $images
    ) {}

    /**
     * Search public properties with filters and availability only.
     * @param array<string, mixed> $filters
     * @return LengthAwarePaginator
     */
    public function searchPublic(array $filters, int $perPage = 16): LengthAwarePaginator
    {
        $query = Property::query()
            ->with(['type', 'images', 'videos'])
            ->where('status', 'Disponível');

        $this->applyFilters($query, $filters);

        return $query->latest()->paginate($perPage)->withQueryString();
    }

    /**
     * Search for admin, any status, 20 per page by default.
     */
    public function searchAdmin(array $filters, int $perPage = 20): LengthAwarePaginator
    {
        $query = Property::query()->with(['type', 'images', 'videos']);
        $this->applyFilters($query, $filters);
        return $query->latest()->paginate($perPage)->withQueryString();
    }

    /**
     * Create a property with optional images.
     * @param array<string, mixed> $data
     * @param array<int, \Illuminate\Http\UploadedFile> $files
     */
    public function create(array $data, array $files = []): Property
    {
        return DB::transaction(function () use ($data, $files) {
            $data['slug'] = $data['slug'] ?? Str::slug($data['title']).'-'.Str::random(6);
            $property = Property::create($data);

            if (!empty($files)) {
                $paths = $this->images->storePropertyImages($property->id, $files);
                foreach ($paths as $i => $path) {
                    $property->images()->create([
                        'path' => $path,
                        'is_cover' => $i === 0, // primeira imagem vira capa por padrão
                        'sort_order' => $i,
                    ]);
                }
            }
            // Videos (YouTube URLs)
            $videoUrls = array_filter(($data['video_urls'] ?? []), fn($u) => is_string($u) && trim($u) !== '');
            if (!empty($videoUrls)) {
                $start = (int) max(
                    (int) ($property->images()->max('sort_order') ?? -1),
                    (int) ($property->videos()->max('sort_order') ?? -1)
                ) + 1;

                foreach (array_values($videoUrls) as $i => $url) {
                    $vid = \App\Services\VideoService::extractYouTubeId($url);
                    if (!$vid) continue;
                    $property->videos()->create([
                        'provider' => 'youtube',
                        'video_id' => $vid,
                        'url' => $url,
                        'is_cover' => false,
                        'sort_order' => $start + $i,
                    ]);
                }
            }

            return $property->load(['type', 'images', 'videos']);
        });
    }

    /**
     * Update property and optionally upload more images.
     * @param array<string, mixed> $data
     * @param array<int, \Illuminate\Http\UploadedFile> $files
     */
    public function update(Property $property, array $data, array $files = []): Property
    {
        return DB::transaction(function () use ($property, $data, $files) {
            if (isset($data['title']) && empty($data['slug'])) {
                $data['slug'] = Str::slug($data['title']).'-'.Str::random(6);
            }
            $property->update($data);

            if (!empty($files)) {
                $start = (int) $property->images()->max('sort_order') + 1;
                $paths = $this->images->storePropertyImages($property->id, $files);
                foreach ($paths as $i => $path) {
                    $property->images()->create([
                        'path' => $path,
                        'is_cover' => false,
                        'sort_order' => $start + $i,
                    ]);
                }
            }
            // Videos (YouTube URLs)
            $videoUrls = array_filter(($data['video_urls'] ?? []), fn($u) => is_string($u) && trim($u) !== '');
            if (!empty($videoUrls)) {
                $startV = (int) max(
                    (int) ($property->images()->max('sort_order') ?? -1),
                    (int) ($property->videos()->max('sort_order') ?? -1)
                ) + 1;

                foreach (array_values($videoUrls) as $i => $url) {
                    $vid = \App\Services\VideoService::extractYouTubeId($url);
                    if (!$vid) continue;
                    $property->videos()->create([
                        'provider' => 'youtube',
                        'video_id' => $vid,
                        'url' => $url,
                        'is_cover' => false,
                        'sort_order' => $startV + $i,
                    ]);
                }
            }

            return $property->load(['type', 'images', 'videos']);
        });
    }

    public function delete(Property $property): void
    {
        DB::transaction(function () use ($property) {
            foreach ($property->images as $img) {
                $this->images->delete($img->path);
            }
            $property->delete();
        });
    }

    public function setCover(Property $property, PropertyImage $image): void
    {
        DB::transaction(function () use ($property, $image) {
            $property->images()->update(['is_cover' => false]);
            $property->videos()->update(['is_cover' => false]);
            $image->update(['is_cover' => true]);
        });
    }

    public function removeImage(PropertyImage $image): void
    {
        DB::transaction(function () use ($image) {
            $this->images->delete($image->path);
            $image->delete();
        });
    }

    public function setCoverVideo(Property $property, PropertyVideo $video): void
    {
        DB::transaction(function () use ($property, $video) {
            $property->images()->update(['is_cover' => false]);
            $property->videos()->update(['is_cover' => false]);
            $video->update(['is_cover' => true]);
        });
    }

    public function removeVideo(PropertyVideo $video): void
    {
        DB::transaction(function () use ($video) {
            $video->delete();
        });
    }

    /**
     * Reorder gallery (images + videos) given array of items ordered.
     * @param array<int, array{type:string,id:int}> $items
     */
    public function reorderMedia(Property $property, array $items): void
    {
        DB::transaction(function () use ($property, $items) {
            foreach (array_values($items) as $i => $item) {
                if (($item['type'] ?? '') === 'image') {
                    $property->images()->whereKey((int)$item['id'])->update(['sort_order' => $i]);
                } elseif (($item['type'] ?? '') === 'video') {
                    $property->videos()->whereKey((int)$item['id'])->update(['sort_order' => $i]);
                }
            }
        });
    }

    /**
     * Increment property views counter safely.
     */
    public function incrementViews(Property $property): void
    {
        Property::whereKey($property->id)->increment('views');
    }

    /**
     * Apply common filters to a query builder.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array<string, mixed> $filters
     */
    private function applyFilters($query, array $filters): void
    {
        if (!empty($filters['city'])) {
            $query->where('city', 'like', '%'.trim($filters['city']).'%');
        }
        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', (float) $filters['max_price']);
        }
        if (!empty($filters['type'])) {
            $query->whereHas('type', function ($q) use ($filters) {
                $q->where('slug', $filters['type'])->orWhere('id', $filters['type']);
            });
        }
        if (!empty($filters['bedrooms'])) {
            $query->where('bedrooms', '>=', (int) $filters['bedrooms']);
        }
        if (!empty($filters['bathrooms'])) {
            $query->where('bathrooms', '>=', (int) $filters['bathrooms']);
        }
        if (!empty($filters['garages'])) {
            $query->where('garages', '>=', (int) $filters['garages']);
        }
        if (!empty($filters['min_area'])) {
            $query->where('area', '>=', (int) $filters['min_area']);
        }
    }
}
