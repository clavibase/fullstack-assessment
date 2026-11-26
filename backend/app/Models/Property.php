<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'area', 'price_per_night', 'bedrooms', 'is_available', 'description'])]
class Property extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price_per_night' => 'integer',
            'bedrooms' => 'integer',
            'is_available' => 'boolean',
        ];
    }
}
