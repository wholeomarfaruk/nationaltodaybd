<?php

namespace App\Services\PhotoCard\Elements;

use Imagick;
use ImagickDraw;
use ImagickPixel;

/**
 * A rounded-pill background with centered (usually Bengali) text — e.g. the
 * "বিস্তারিত কমেন্টে" call-to-action. One element instead of a rectangle +
 * text pair that must be manually aligned.
 *
 * Config: x, y, w, h, radius, fill, value/field, font, size, color, align.
 */
class BadgeElement extends AbstractElement
{
    public function type(): string
    {
        return 'badge';
    }

    public function render(Imagick $canvas, array $element, array $data): ?RenderedLayer
    {
        $w = (int) ($element['w'] ?? 0);
        $h = (int) ($element['h'] ?? 0);
        if ($w <= 0 || $h <= 0) {
            return null;
        }

        [$x, $y] = $this->resolvePosition($canvas, $element, $w, $h);

        $text = !empty($element['field'])
            ? trim((string) ($data[$element['field']] ?? ''))
            : trim((string) ($element['value'] ?? ''));

        $layer = $this->layers->newLayer($w, $h);

        // Pill background.
        $radius = (int) ($element['radius'] ?? ($h / 2));
        $bg = new ImagickDraw();
        $bg->setFillColor(new ImagickPixel($element['fill'] ?? '#ff0000'));
        $bg->roundRectangle(0, 0, $w - 1, $h - 1, $radius, $radius);
        $layer->drawImage($bg);

        // Centered label.
        if ($text !== '') {
            $draw = new ImagickDraw();
            $fontPath = public_path($element['font'] ?? '');
            if ($fontPath && is_file($fontPath)) {
                $draw->setFont($fontPath);
            }
            $size = (int) ($element['size'] ?? 24);
            $draw->setFontSize($size);
            $draw->setFillColor(new ImagickPixel($element['color'] ?? '#ffffff'));

            $metrics = $layer->queryFontMetrics($draw, $text);
            $tx = ($w - ($metrics['textWidth'] ?? 0)) / 2;
            // Vertically center using ascender/descender for a true midline.
            $ascender = $metrics['ascender'] ?? $size * 0.8;
            $descender = $metrics['descender'] ?? -$size * 0.2;
            $ty = ($h / 2) + (($ascender + $descender) / 2);

            $layer->annotateImage($draw, $tx, $ty, 0, $text);
        }

        return new RenderedLayer($layer, $x, $y);
    }
}
