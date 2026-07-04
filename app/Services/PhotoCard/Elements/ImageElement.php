<?php

namespace App\Services\PhotoCard\Elements;

use Imagick;
use ImagickPixel;

class ImageElement extends AbstractElement
{
    public function type(): string
    {
        return 'image';
    }

    public function render(Imagick $canvas, array $element, array $data): ?RenderedLayer
    {
        $field = $element['field'] ?? null;
        $path = $element['src'] ?? ($field ? ($data[$field] ?? null) : null);

        if (!$path) {
            return null;
        }

        $fullPath = $this->normalizePath($path);
        if (!is_file($fullPath)) {
            return null;
        }

        $w = (int) ($element['w'] ?? 0);
        $h = (int) ($element['h'] ?? 0);
        if ($w <= 0 || $h <= 0) {
            return null;
        }

        [$x, $y] = $this->resolvePosition($canvas, $element, $w, $h);

        $img = new Imagick($fullPath);
        $this->applyFit($img, $w, $h, $element['fit'] ?? 'contain');

        // Ensure the source carries an alpha channel so it composites as a normal
        // RGBA layer. JPEGs have none by default; without this, ImageMagick treats
        // the composite as opaque and corrupts the alpha of regions already drawn
        // on the canvas (the black-box artefact). Only add opaque alpha when the
        // image has none — never flatten a PNG logo's real transparency.
        if (!$img->getImageAlphaChannel()) {
            $img->setImageAlphaChannel(Imagick::ALPHACHANNEL_OPAQUE);
        }

        // Place the (possibly smaller, for "contain") image centered in a
        // transparent layer of the target box so positioning stays predictable.
        $layer = $this->layers->newLayer($w, $h);
        $offsetX = (int) (($w - $img->getImageWidth()) / 2);
        $offsetY = (int) (($h - $img->getImageHeight()) / 2);
        $layer->compositeImage($img, Imagick::COMPOSITE_OVER, $offsetX, $offsetY);
        $img->clear();
        $img->destroy();

        return new RenderedLayer($layer, $x, $y);
    }

    protected function applyFit(Imagick $img, int $targetW, int $targetH, string $fit): void
    {
        match ($fit) {
            'stretch' => $img->resizeImage($targetW, $targetH, Imagick::FILTER_LANCZOS, 1),
            'cover' => $this->fitCover($img, $targetW, $targetH),
            default => $this->fitContain($img, $targetW, $targetH),
        };
    }

    protected function fitCover(Imagick $img, int $targetW, int $targetH): void
    {
        $srcRatio = $img->getImageWidth() / $img->getImageHeight();
        $targetRatio = $targetW / $targetH;

        if ($srcRatio > $targetRatio) {
            $newH = $targetH;
            $newW = (int) round($newH * $srcRatio);
        } else {
            $newW = $targetW;
            $newH = (int) round($newW / $srcRatio);
        }

        $img->resizeImage($newW, $newH, Imagick::FILTER_LANCZOS, 1);
        $img->cropImage($targetW, $targetH, (int) (($newW - $targetW) / 2), (int) (($newH - $targetH) / 2));
        $img->setImagePage(0, 0, 0, 0);
    }

    protected function fitContain(Imagick $img, int $targetW, int $targetH): void
    {
        $srcRatio = $img->getImageWidth() / $img->getImageHeight();
        $targetRatio = $targetW / $targetH;

        if ($srcRatio > $targetRatio) {
            $newW = $targetW;
            $newH = (int) round($newW / $srcRatio);
        } else {
            $newH = $targetH;
            $newW = (int) round($newH * $srcRatio);
        }

        $img->resizeImage($newW, $newH, Imagick::FILTER_LANCZOS, 1);
    }

    protected function normalizePath(string $path): string
    {
        if (str_starts_with($path, public_path())) {
            return $path;
        }

        return public_path($path);
    }
}
