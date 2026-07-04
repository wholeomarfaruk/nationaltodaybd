<?php

namespace App\Services\PhotoCard\Elements;

use Imagick;
use ImagickPixel;

/**
 * A linear gradient fill (e.g. dark-to-transparent overlay for legibility).
 *
 * Config:
 *   x, y, w, h              placement + size
 *   from   (default #000000ff)  start colour  (top / left)
 *   to     (default #00000000)  end colour    (bottom / right)
 *   direction: "vertical" (default) | "horizontal"
 *
 * Colours accept #rrggbb or #rrggbbaa. Per-element "opacity" still applies.
 */
class GradientElement extends AbstractElement
{
    public function type(): string
    {
        return 'gradient';
    }

    public function render(Imagick $canvas, array $element, array $data): ?RenderedLayer
    {
        $w = (int) ($element['w'] ?? $canvas->getImageWidth());
        $h = (int) ($element['h'] ?? 0);

        if ($w <= 0 || $h <= 0) {
            return null;
        }

        [$x, $y] = $this->resolvePosition($canvas, $element, $w, $h);

        $from = $element['from'] ?? '#000000ff';
        $to = $element['to'] ?? '#00000000';

        $gradient = new Imagick();

        // Imagick gradients are generated top→bottom; rotate for horizontal.
        if (($element['direction'] ?? 'vertical') === 'horizontal') {
            $gradient->newPseudoImage($h, $w, "gradient:{$from}-{$to}");
            $gradient->rotateImage(new ImagickPixel('transparent'), 90);
        } else {
            $gradient->newPseudoImage($w, $h, "gradient:{$from}-{$to}");
        }

        $gradient->setImageFormat('png');
        $gradient->setImageAlphaChannel(Imagick::ALPHACHANNEL_ACTIVATE);

        $layer = $this->layers->newLayer($w, $h);
        $layer->compositeImage($gradient, Imagick::COMPOSITE_OVER, 0, 0);
        $gradient->clear();
        $gradient->destroy();

        return new RenderedLayer($layer, $x, $y);
    }
}
