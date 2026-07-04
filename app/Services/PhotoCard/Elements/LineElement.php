<?php

namespace App\Services\PhotoCard\Elements;

use ImagickDraw;
use ImagickPixel;
use Imagick;

/**
 * A straight divider line. Defined by x,y (start) and either w (horizontal)
 * or an explicit x2,y2 endpoint, with a thickness.
 */
class LineElement extends AbstractElement
{
    public function type(): string
    {
        return 'line';
    }

    public function render(Imagick $canvas, array $element, array $data): ?RenderedLayer
    {
        $thickness = max(1, (int) ($element['thickness'] ?? $element['h'] ?? 2));
        $color = $element['color'] ?? $element['fill'] ?? '#000000';

        $x1 = (int) ($element['x'] ?? 0);
        $y1 = (int) ($element['y'] ?? 0);

        if (isset($element['w'])) {
            $x2 = $x1 + (int) $element['w'];
            $y2 = $y1;
        } else {
            $x2 = (int) ($element['x2'] ?? $x1);
            $y2 = (int) ($element['y2'] ?? $y1);
        }

        $originX = min($x1, $x2);
        $originY = min($y1, $y2);
        $w = max(1, abs($x2 - $x1)) + $thickness;
        $h = max(1, abs($y2 - $y1)) + $thickness;

        $layer = $this->layers->newLayer($w, $h);

        $draw = new ImagickDraw();
        $draw->setStrokeColor(new ImagickPixel($color));
        $draw->setStrokeWidth($thickness);
        $draw->setStrokeLineCap(Imagick::LINECAP_ROUND);
        $draw->line(
            $x1 - $originX + $thickness / 2,
            $y1 - $originY + $thickness / 2,
            $x2 - $originX + $thickness / 2,
            $y2 - $originY + $thickness / 2
        );

        $layer->drawImage($draw);

        return new RenderedLayer($layer, $originX, $originY);
    }
}
