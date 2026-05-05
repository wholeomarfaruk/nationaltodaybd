<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoPost extends Model
{
        public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
// Post.php model
public function getFeaturedImageAttribute()
{
    $media = $this->media?->where('category', 'image')->first();

    if ($media && file_exists(public_path('uploads/'.$media->path))) {
        return asset('uploads/'.$media->path);
    }

    return asset('website/img/thumbnails/featured_img.jpg');
}

}
