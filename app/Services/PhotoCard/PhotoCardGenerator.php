<?php

namespace App\Services\PhotoCard;

use Exception;
use Imagick;
use ImagickDraw;
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
            throw new Exception('Imagick PHP extension is required but not installed');
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
            new ImagickPixel($template['canvas']['background'])
        );
        $canvas->setImageFormat('png');

        // Draw main image if provided
        if (!empty($data['image']) && isset($template['layout']['image'])) {
            \Log::info("Compositing image", ['image_path' => $data['image']]);
            try {
                $this->imageRenderer->compositeImage(
                    $canvas,
                    $template['layout']['image'],
                    $data['image']
                );
            } catch (\Exception $e) {
                \Log::warning("Could not composite image", ['error' => $e->getMessage()]);
            }
        }

        // Draw category if provided
        if (!empty($data['category']) && isset($template['layout']['category']) && isset($template['fonts']['caption'])) {
            $this->imageRenderer->drawText(
                $canvas,
                $template['layout']['category'],
                $data['category'],
                $template['fonts']['caption']
            );
        }

        // Draw title
        $this->imageRenderer->drawText(
            $canvas,
            $template['layout']['title'],
            $data['title'],
            $template['fonts']['title']
        );

        // Draw caption if provided
        if (!empty($data['caption']) && isset($template['layout']['caption'])) {
            $captionFont = $template['fonts']['caption'] ?? $template['fonts']['title'];
            $this->imageRenderer->drawText(
                $canvas,
                $template['layout']['caption'],
                $data['caption'],
                $captionFont
            );
        }

        // Draw logo if provided
        if (!empty($data['logo']) && isset($template['branding']['logo_position'])) {
            \Log::info("Compositing logo", ['logo_path' => $data['logo']]);
            $this->imageRenderer->compositeImage(
                $canvas,
                $template['branding']['logo_position'],
                $data['logo']
            );
        }

        // Draw date if provided
        if (!empty($data['date']) && isset($template['layout']['footer'])) {
            $dateStr = $this->formatDate($data['date'], $template['date_format']);
            $footerText = $dateStr . ' · ' . $template['branding']['footer_text'];
            $this->imageRenderer->drawText(
                $canvas,
                $template['layout']['footer'],
                $footerText,
                $template['fonts']['footer'] ?? $template['fonts']['title']
            );
        }

        $outputPath = $outputDir . '/' . uniqid('photocard_') . '.png';
        $canvas->writeImage($outputPath);
        $canvas->clear();

        \Log::info("✓ Imagick image generated", ['path' => $outputPath, 'size' => filesize($outputPath)]);

        return $outputPath;
    }

    protected function formatDate(string $date, string $format): string
    {
        $timestamp = strtotime($date);
        return date($format, $timestamp);
    }

    protected function hexToRgb(string $hex): array
    {
        $hex = ltrim($hex, '#');
        if (strlen($hex) === 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }

        return [
            'r' => hexdec(substr($hex, 0, 2)),
            'g' => hexdec(substr($hex, 2, 2)),
            'b' => hexdec(substr($hex, 4, 2)),
        ];
    }
}
