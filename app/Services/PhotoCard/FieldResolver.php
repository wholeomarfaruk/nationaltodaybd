<?php

namespace App\Services\PhotoCard;

use App\Services\PhotoCard\Support\BengaliFormatter;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class FieldResolver
{
    public function __construct(
        protected BengaliFormatter $formatter,
    ) {}

    /**
     * Resolve every field mapping into a flat data array.
     *
     * @param  string|null  $dateFormat  Template's date_format (e.g. "d M, Y").
     */
    public function resolve(Post $post, Collection $fieldMaps, ?string $dateFormat = null): array
    {
        $data = [];

        foreach ($fieldMaps as $map) {
            $value = match ($map->source_type) {
                'post_field' => $this->resolvePostField($post, $map->source_value, $dateFormat),
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

    protected function resolvePostField(Post $post, string $field, ?string $dateFormat): ?string
    {
        return match ($field) {
            'title' => $post->title,
            'excerpt' => $post->excerpt ?? '',
            'featured_image_path' => $this->resolveFeaturedImagePath($post),
            'category_name' => $post->category?->name ?? '',
            'created_at' => $this->formatter->formatDate($post->created_at, $dateFormat),
            default => null,
        };
    }

    protected function resolveSetting(string $setting): ?string
    {
        return match ($setting) {
            'site_logo' => $this->resolveLogoPath(),
            default => null,
        };
    }

    /**
     * Prefer a configured logo from settings; fall back to the bundled logo.
     */
    protected function resolveLogoPath(): ?string
    {
        $configured = function_exists('setting') ? setting('site_logo') : null;

        $candidates = array_filter([
            $configured ? public_path(ltrim(str_replace(asset(''), '', $configured), '/')) : null,
            public_path('uploads/logo/logo.png'),
            public_path('logo.png'),
        ]);

        foreach ($candidates as $path) {
            if (is_file($path)) {
                return $path;
            }
        }

        return null;
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

        return is_file($path) ? $path : null;
    }
}
