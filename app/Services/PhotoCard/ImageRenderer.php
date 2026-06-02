<?php

namespace App\Services\PhotoCard;

use Exception;
use Imagick;
use ImagickDraw;
use ImagickPixel;

class ImageRenderer
{
    public function drawText(Imagick $canvas, array $layout, string $text, array $font): void
    {
        $draw = new ImagickDraw();

        $fontPath = public_path($font['file']);
        if (file_exists($fontPath)) {
            $draw->setFont($fontPath);
        }

        $draw->setFontSize($font['size']);
        $draw->setFillColor(new ImagickPixel($font['color']));

        $canvas->annotateImage(
            $draw,
            $layout['x'],
            $layout['y'],
            0,
            $text
        );
    }

    public function compositeImage(Imagick $canvas, array $layout, string $path): void
    {
        $fullPath = $this->normalizePath($path);

        if (!file_exists($fullPath)) {
            throw new Exception("Image file not found: {$path}");
        }

        $img = new Imagick($fullPath);
        $img->resizeImage($layout['w'], $layout['h'], Imagick::FILTER_LANCZOS, 1);

        $canvas->compositeImage($img, Imagick::COMPOSITE_OVER, $layout['x'], $layout['y']);
        $img->clear();
    }

    protected function normalizePath(string $path): string
    {
        if (str_starts_with($path, public_path())) {
            return $path;
        }
        return public_path($path);
    }
}
