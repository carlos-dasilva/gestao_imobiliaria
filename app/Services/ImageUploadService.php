<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    /**
     * Store multiple images for a property and return stored paths
     * Ensures files are stored under public disk for web access.
     *
     * @param  array<int, UploadedFile>  $files
     * @return array<int, string>
     */
    public function storePropertyImages(int $propertyId, array $files): array
    {
        $stored = [];
        foreach ($files as $file) {
            if (!$file instanceof UploadedFile) {
                continue;
            }
            $name = Str::uuid()->toString().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs("properties/{$propertyId}", $name, 'public');
            $stored[] = $path; // relative to public disk
        }
        return $stored;
    }

    public function delete(string $path): void
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}

