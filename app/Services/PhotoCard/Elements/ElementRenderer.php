<?php

namespace App\Services\PhotoCard\Elements;

use Imagick;

/**
 * Renders one element type onto its own transparent layer.
 *
 * Implementations return a RenderedLayer (layer + canvas position) OR null
 * when there is nothing to draw (e.g. a bound field with no data). The
 * dispatcher then applies element-level modifiers and composites the layer.
 */
interface ElementRenderer
{
    /**
     * The "type" value in template JSON this renderer handles.
     */
    public function type(): string;

    /**
     * @param  Imagick  $canvas  Read-only reference for dimensions / font metrics.
     * @param  array    $element Element config from the template.
     * @param  array    $data    Resolved field data (title, logo path, ...).
     */
    public function render(Imagick $canvas, array $element, array $data): ?RenderedLayer;
}
