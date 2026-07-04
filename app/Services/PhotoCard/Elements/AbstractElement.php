<?php

namespace App\Services\PhotoCard\Elements;

use App\Services\PhotoCard\Support\LayerFactory;
use Imagick;

abstract class AbstractElement implements ElementRenderer
{
    public function __construct(
        protected LayerFactory $layers,
    ) {}

    /**
     * Resolve center_x / center_y into concrete x/y given the element's
     * own width/height and the canvas size.
     */
    protected function resolvePosition(
        Imagick $canvas,
        array $element,
        int $width,
        int $height
    ): array {
        $x = (int) ($element['x'] ?? 0);
        $y = (int) ($element['y'] ?? 0);

        if (!empty($element['center_x'])) {
            $x = (int) (($canvas->getImageWidth() - $width) / 2);
        }

        if (!empty($element['center_y'])) {
            $y = (int) (($canvas->getImageHeight() - $height) / 2);
        }

        return [$x, $y];
    }
}
