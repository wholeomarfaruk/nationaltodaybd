<?php

namespace App\Services\PhotoCard;

use App\Models\PhotoCardTemplate;
use Exception;

class TemplateResolver
{
    /**
     * Load an active template's config array by slug.
     */
    public function load(string $slug): array
    {
        return $this->loadModel($slug)->config;
    }

    /**
     * Load the active template model by slug (config + relations available).
     */
    public function loadModel(string $slug): PhotoCardTemplate
    {
        $template = PhotoCardTemplate::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (!$template) {
            throw new Exception("Template not found or inactive: {$slug}");
        }

        return $template;
    }

    public function validate(array $template, array $data): void
    {
        foreach ($template['required_fields'] ?? [] as $field) {
            if (empty($data[$field])) {
                throw new Exception("Missing required field: {$field}");
            }
        }
    }
}
