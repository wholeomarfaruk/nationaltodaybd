<?php

namespace App\Services\PhotoCard\Elements;

use ImagickDraw;
use ImagickPixel;
use Imagick;

/**
 * A filled circle or ellipse. "d" (diameter) makes a circle; "w"/"h" make an
 * ellipse. Positioned by top-left x/y (consistent with other elements).
 */
class CircleElement extends AbstractElement
{
    public function type(): string
    {
        return 'circle';
    }

    public function render(Imagick $canvas, array $element, array $data): ?RenderedLayer
    {
        $w = (int) ($element['w'] ?? $element['d'] ?? 0);
        $h = (int) ($element['h'] ?? $element['d'] ?? $w);

        if ($w <= 0 || $h <= 0) {
            return null;
        }

        [$x, $y] = $this->resolvePosition($canvas, $element, $w, $h);

        $layer = $this->layers->newLayer($w, $h);

        $draw = new ImagickDraw();
        $draw->setFillColor(new ImagickPixel($element['fill'] ?? '#000000'));

        // ellipse(cx, cy, rx, ry, start, end)
        $draw->ellipse($w / 2, $h / 2, $w / 2 - 1, $h / 2 - 1, 0, 360);

        $layer->drawImage($draw);

        return new RenderedLayer($layer, $x, $y);
    }
}
