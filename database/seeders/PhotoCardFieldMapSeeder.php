<?php

namespace Database\Seeders;

use App\Models\PhotoCardFieldMap;
use App\Models\PhotoCardTemplate;
use Illuminate\Database\Seeder;

class PhotoCardFieldMapSeeder extends Seeder
{
    public function run(): void
    {
        $templates = PhotoCardTemplate::all();

        $defaultMaps = [
            'title' => ['source_type' => 'post_field', 'source_value' => 'title'],
            'logo' => ['source_type' => 'setting', 'source_value' => 'site_logo'],
            'image' => ['source_type' => 'post_field', 'source_value' => 'featured_image_path'],
            'caption' => ['source_type' => 'post_field', 'source_value' => 'excerpt'],
            'date' => ['source_type' => 'post_field', 'source_value' => 'created_at'],
            'category' => ['source_type' => 'post_field', 'source_value' => 'category_name'],
        ];

        foreach ($templates as $template) {
            foreach ($defaultMaps as $fieldKey => $mapping) {
                PhotoCardFieldMap::updateOrCreate(
                    [
                        'photocard_template_id' => $template->id,
                        'field_key' => $fieldKey,
                    ],
                    [
                        'source_type' => $mapping['source_type'],
                        'source_value' => $mapping['source_value'],
                    ]
                );
            }
        }
    }
}
