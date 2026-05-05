<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'title',
        'description',
        'link',
        'status',
        'expire_at',
        'ad_rule',
        'is_primary',
    ];
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
    public function getImageAttribute()
    {
        $media = $this->media?->where('category', 'image')->first();

        if ($media && file_exists(public_path('uploads/' . $media->path))) {
            return asset('uploads/' . $media->path);
        }

        return asset('website/img/thumbnails/featured_img.jpg');
    }
}
