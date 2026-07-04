<?php

namespace Database\Seeders;

use App\Models\PhotoCardTemplate;
use App\Services\PhotoCard\PreviewGenerator;
use Illuminate\Database\Seeder;

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

            $model = PhotoCardTemplate::updateOrCreate(
                ['slug' => $template['slug']],
                [
                    'name' => $template['name'] ?? basename($file, '.json'),
                    'description' => $template['description'] ?? null,
                    'config' => $template,
                    'is_active' => true,
                ]
            );

            $this->command->info("✓ Seeded template: {$template['slug']}");

            // Generate a preview thumbnail so admins can see the template.
            if (extension_loaded('imagick')) {
                $preview = app(PreviewGenerator::class)->generate($model);
                $this->command->{$preview ? 'info' : 'warn'}(
                    ($preview ? '  ✓ preview: ' : '  ✗ preview failed: ') . $template['slug']
                );
            }
        }
    }
}
