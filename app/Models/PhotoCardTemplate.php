<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhotoCardTemplate extends Model
{
    protected $table = 'photocard_templates';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'config',
        'preview_image',
        'is_active',
    ];

    protected $casts = [
        'config' => 'array',
        'is_active' => 'boolean',
    ];

    public function fieldMaps(): HasMany
    {
        return $this->hasMany(PhotoCardFieldMap::class, 'photocard_template_id');
    }
}
