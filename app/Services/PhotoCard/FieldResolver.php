<?php

namespace App\Services\PhotoCard;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class FieldResolver
{
    public function resolve(Post $post, Collection $fieldMaps): array
    {
        $data = [];

        foreach ($fieldMaps as $map) {
            $value = match ($map->source_type) {
                'post_field' => $this->resolvePostField($post, $map->source_value),
                'setting' => $this->resolveSetting($map->source_value),
                'static' => $map->source_value,
                default => null,
            };

            if ($value !== null) {
                $data[$map->field_key] = $value;
            }
        }

        return $data;
    }

    protected function resolvePostField(Post $post, string $field): ?string
    {
        return match ($field) {
            'title' => $post->title,
            'excerpt' => $post->excerpt ?? '',
            'featured_image_path' => $this->resolveFeaturedImagePath($post),
            'category_name' => $post->category?->name ?? '',
            'created_at' => $post->created_at->toDateString(),
            default => null,
        };
    }

    protected function resolveSetting(string $setting): ?string
    {
        return match ($setting) {
            'site_logo' => public_path('uploads/logo/logo.png'),
            default => null,
        };
    }

    protected function resolveFeaturedImagePath(Post $post): ?string
    {
        $media = $post->media()
            ->where('category', 'featured_image')
            ->first();

        if (!$media || !$media->path) {
            return null;
        }

        $path = public_path('uploads/' . $media->path);

        if (!file_exists($path)) {
            return null;
        }

        return $path;
    }
}
