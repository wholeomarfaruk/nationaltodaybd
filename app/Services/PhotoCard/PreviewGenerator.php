<?php

namespace App\Services\PhotoCard;

use App\Models\PhotoCardTemplate;
use App\Services\PhotoCard\Support\BengaliFormatter;
use Illuminate\Support\Carbon;

/**
 * Renders a template with representative sample data so admins can see what a
 * template produces. Stores the relative path in `preview_image`.
 */
class PreviewGenerator
{
    public function __construct(
        protected PhotoCardService $service,
        protected BengaliFormatter $formatter,
    ) {}

    /**
     * Generate (or regenerate) the preview for a template. Returns the public
     * relative path stored on the model, or null if rendering failed.
     */
    public function generate(PhotoCardTemplate $template): ?string
    {
        $config = $template->config;

        $relative = 'photocards/previews/' . $template->slug . '.png';
        $absolute = public_path($relative);

        try {
            $this->service->renderToFile($config, $this->sampleData(), $absolute);
        } catch (\Throwable $e) {
            \Log::warning('PhotoCard preview generation failed', [
                'slug' => $template->slug,
                'error' => $e->getMessage(),
            ]);
            return null;
        }

        // Store with a cache-busting version so the admin thumbnail refreshes.
        $stored = $relative . '?v=' . time();
        $template->forceFill(['preview_image' => $stored])->save();

        return $stored;
    }

    protected function sampleData(): array
    {
        $sampleImage = public_path('website/img/thumbnails/featured_img.jpg');
        $logo = public_path('uploads/logo/logo.png');

        return [
            'title' => 'চট্টগ্রাম বিশ্ববিদ্যালয়ে ব্রাজিল ভক্তদের বাঁধভাঙ্গা উল্লাস ও স্লোগান',
            'excerpt' => 'নমুনা সংক্ষিপ্ত বিবরণ এখানে প্রদর্শিত হবে।',
            'category' => 'খেলাধুলা',
            'date' => $this->formatter->formatDate(Carbon::now(), 'j M, Y'),
            'logo' => is_file($logo) ? $logo : null,
            'image' => is_file($sampleImage) ? $sampleImage : null,
        ];
    }
}
