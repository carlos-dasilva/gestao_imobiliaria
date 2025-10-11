<?php

namespace App\Services;

use App\Models\PropertyType;
use Illuminate\Support\Str;

class PropertyTypeService
{
    public function create(array $data): PropertyType
    {
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        return PropertyType::create($data);
    }

    public function update(PropertyType $type, array $data): PropertyType
    {
        if (isset($data['name']) && empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        $type->update($data);
        return $type;
    }

    public function delete(PropertyType $type): void
    {
        $type->delete();
    }
}

