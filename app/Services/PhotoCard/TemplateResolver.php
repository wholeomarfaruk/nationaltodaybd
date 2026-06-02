<?php

namespace App\Services\PhotoCard;

use App\Models\PhotoCardTemplate;
use Exception;

class TemplateResolver
{
    public function load(string $slug): array
    {
        $template = PhotoCardTemplate::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (!$template) {
            throw new Exception("Template not found or inactive: {$slug}");
        }

        return $template->config;
    }

    public function validate(array $template, array $data): void
    {
        if (empty($template['required_fields'])) {
            return;
        }

        foreach ($template['required_fields'] as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                throw new Exception("Missing required field: {$field}");
            }
        }
    }
}
