<?php

namespace App\Services\PhotoCard;

use Imagick;
use ImagickPixel;

class PhotoCardGenerator
{
    protected TemplateResolver $templateResolver;
    protected ImageRenderer $imageRenderer;

    public function __construct(
        TemplateResolver $templateResolver,
        ImageRenderer $imageRenderer
    ) {
        $this->templateResolver = $templateResolver;
        $this->imageRenderer = $imageRenderer;
    }

    public function generate(array $template, array $data): string
    {
        $this->templateResolver->validate($template, $data);

        if (!extension_loaded('imagick')) {
            throw new \Exception('Imagick extension not installed');
        }

        return $this->generateWithImagick($template, $data);
    }

    protected function generateWithImagick(array $template, array $data): string
    {
        $outputDir = public_path('photocards');

        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        $canvas = new Imagick();

        $canvas->newImage(
            $template['canvas']['width'],
            $template['canvas']['height'],
            new ImagickPixel(
                $template['canvas']['background'] ?? '#ffffff'
            )
        );

        $canvas->setImageFormat('png');

        /*
        |--------------------------------------------------------------------------
        | Render Elements
        |--------------------------------------------------------------------------
        */

        foreach ($template['elements'] ?? [] as $element) {

            try {

                $this->imageRenderer->render(
                    $canvas,
                    $element,
                    $data
                );

            } catch (\Throwable $e) {

                \Log::warning('Element render failed', [
                    'type' => $element['type'] ?? 'unknown',
                    'error' => $e->getMessage()
                ]);
            }
        }

        $outputPath =
            $outputDir .
            '/' .
            uniqid('photocard_') .
            '.png';

        $canvas->writeImage($outputPath);

        $canvas->clear();
        $canvas->destroy();

        \Log::info('Photocard generated', [
            'path' => $outputPath
        ]);

        return $outputPath;
    }
}