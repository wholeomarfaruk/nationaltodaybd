<?php

namespace App\Services\PhotoCard\Elements;

use ImagickDraw;
use ImagickPixel;
use Imagick;

class RectangleElement extends AbstractElement
{
    public function type(): string
    {
        return 'rectangle';
    }

    public function render(Imagick $canvas, array $element, array $data): ?RenderedLayer
    {
        $w = (int) ($element['w'] ?? 0);
        $h = (int) ($element['h'] ?? 0);

        if ($w <= 0 || $h <= 0) {
            return null;
        }

        [$x, $y] = $this->resolvePosition($canvas, $element, $w, $h);

        $layer = $this->layers->newLayer($w, $h);

        $draw = new ImagickDraw();
        $draw->setFillColor(new ImagickPixel($element['fill'] ?? '#ffffff'));

        $radius = (int) ($element['radius'] ?? 0);
        if ($radius > 0) {
            $draw->roundRectangle(0, 0, $w - 1, $h - 1, $radius, $radius);
        } else {
            $draw->rectangle(0, 0, $w - 1, $h - 1);
        }

        $layer->drawImage($draw);

        // radius already handled by the shape; don't re-clip in modifiers
        return new RenderedLayer($layer, $x, $y);
    }
}
