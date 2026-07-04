<?php

namespace App\Services\PhotoCard\Elements;

use Imagick;

/**
 * An element's finished pixels plus where to composite them on the canvas.
 */
class RenderedLayer
{
    public function __construct(
        public Imagick $layer,
        public int $x,
        public int $y,
    ) {}
}
