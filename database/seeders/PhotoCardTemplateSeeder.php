<?php

namespace Database\Seeders;

use App\Models\PhotoCardTemplate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PhotoCardTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templatesDir = resource_path('photocard-templates');

        if (!is_dir($templatesDir)) {
            $this->command->warn("Templates directory not found: {$templatesDir}");
            return;
        }

        $files = glob("{$templatesDir}/*.json");

        foreach ($files as $file) {
            $content = file_get_contents($file);
            $template = json_decode($content, true);

            if (!$template || empty($template['slug'])) {
                $this->command->warn("Invalid or missing slug in: " . basename($file));
                continue;
            }

            PhotoCardTemplate::updateOrCreate(
                ['slug' => $template['slug']],
                [
                    'name' => $template['name'] ?? basename($file, '.json'),
                    'description' => $template['description'] ?? null,
                    'config' => $template,
                    'is_active' => true,
                ]
            );

            $this->command->info("✓ Seeded template: {$template['slug']}");
        }
    }
}
