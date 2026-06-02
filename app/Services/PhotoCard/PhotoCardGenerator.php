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

        if (extension_loaded('imagick')) {
            return $this->generateWithImagick($template, $data);
        }

        \Log::warning("Imagick not available in running process, falling back to GD");
        return $this->createDemoImage($template, $data);
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

    protected function createDemoImage(array $template, array $data): string
    {
        $outputDir = public_path('photocards');
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        $width = $template['canvas']['width'] ?? 1080;
        $height = $template['canvas']['height'] ?? 1080;
        $bgColor = $template['canvas']['background'] ?? '#ffffff';

        $image = imagecreatetruecolor($width, $height);

        $rgb = $this->hexToRgb($bgColor);
        $bgColorId = imagecolorallocate($image, $rgb['r'], $rgb['g'], $rgb['b']);
        imagefilledrectangle($image, 0, 0, $width, $height, $bgColorId);

        $brightness = ($rgb['r'] * 299 + $rgb['g'] * 587 + $rgb['b'] * 114) / 1000;
        $textColorValue = $brightness > 128 ? [0, 0, 0] : [255, 255, 255];
        $textColor = imagecolorallocate($image, $textColorValue[0], $textColorValue[1], $textColorValue[2]);

        $accentColor = imagecolorallocate($image, 52, 152, 219);
        imagefilledrectangle($image, 0, 0, $width, 80, $accentColor);

        $titleText = $data['title'] ?? 'Photocard';
        $captionText = $data['caption'] ?? '';
        $dateText = $data['date'] ?? date('d M Y');

        $whiteText = imagecolorallocate($image, 255, 255, 255);
        $fontSize = 5;
        $fontWidth = imagefontwidth($fontSize);
        $fontHeight = imagefontheight($fontSize);

        $maxTitleLen = ($width - 40) / $fontWidth;
        $displayTitle = substr($titleText, 0, (int)$maxTitleLen);
        $textWidth = strlen($displayTitle) * $fontWidth;
        $x = max(20, ($width - $textWidth) / 2);
        imagestring($image, $fontSize, (int)$x, 25, $displayTitle, $whiteText);

        if ($captionText) {
            $shortCaption = substr($captionText, 0, 60);
            imagestring($image, 3, 40, $height / 2 - 30, $shortCaption, $textColor);
        }

        $dateLabel = "📅 " . $dateText;
        if (isset($data['category'])) {
            $categoryLabel = "📁 " . substr($data['category'], 0, 30);
            imagestring($image, 2, 40, $height / 2 + 30, $categoryLabel, $textColor);
        }
        imagestring($image, 2, 40, $height / 2 + 60, $dateLabel, $textColor);

        $gray = imagecolorallocate($image, 128, 128, 128);
        imagestring($image, 1, 40, $height - 40, "Demo Mode - Using GD Library", $gray);
        imagestring($image, 1, 40, $height - 25, "nationaltodaybd.com", $gray);

        $outputPath = $outputDir . '/' . uniqid('photocard_') . '.png';
        imagepng($image, $outputPath);
        imagedestroy($image);

        \Log::info("✓ Demo image created (GD fallback)", ['path' => $outputPath, 'size' => filesize($outputPath)]);

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
