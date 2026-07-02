<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id', 'slug'];

    protected static function booted()
    {
        // Guarantee every category always has a unique, non-empty slug.
        static::saving(function (Category $category) {
            $slug = Str::slug((string) $category->slug);

            // Fall back to the name if no slug was explicitly provided.
            if ($slug === '') {
                $slug = Str::slug((string) $category->name);
            }

            // As a last resort (e.g. name is non-latin only), synthesise one.
            if ($slug === '') {
                $slug = 'category-' . Str::random(6);
            }

            $category->slug = static::uniqueSlug($slug, $category->id);
        });
    }

    /**
     * Return a slug that is guaranteed to be unique across categories,
     * ignoring the given id (so a record can keep its own slug on update).
     */
    public static function uniqueSlug(string $slug, $ignoreId = null): string
    {
        $base = $slug;
        $suffix = 2;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $suffix;
            $suffix++;
        }

        return $slug;
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
      public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }
    public function posts(){
        return $this->hasMany(Post::class,'category_id');
    }
}
