<?php

namespace App\Services\PhotoCard;

use App\Services\PhotoCard\Elements\ElementRenderer;
use App\Services\PhotoCard\Support\LayerFactory;
use Imagick;

/**
 * Thin dispatcher: for each element it asks the matching ElementRenderer for a
 * finished layer, applies element-level modifiers to THAT layer, then
 * composites it onto the canvas. No element can affect another element or the
 * whole canvas (the class of bug the previous implementation had).
 */
class ImageRenderer
{
    /** @var array<string, ElementRenderer> */
    protected array $renderers = [];

    /**
     * Element types whose renderer already draws its own rounded shape, so the
     * LayerFactory must NOT re-clip with `radius`.
     */
    protected array $selfRoundingTypes = ['rectangle', 'circle', 'badge'];

    /**
     * @param  iterable<ElementRenderer>  $renderers
     */
    public function __construct(
        protected LayerFactory $layers,
        iterable $renderers = []
    ) {
        foreach ($renderers as $renderer) {
            $this->register($renderer);
        }
    }

    public function register(ElementRenderer $renderer): void
    {
        $this->renderers[$renderer->type()] = $renderer;
    }

    public function renderElement(Imagick $canvas, array $element, array $data): void
    {
        $type = $element['type'] ?? null;
        $renderer = $this->renderers[$type] ?? null;

        if (!$renderer) {
            \Log::warning('PhotoCard: no renderer for element type', ['type' => $type]);
            return;
        }

        $rendered = $renderer->render($canvas, $element, $data);
        if (!$rendered) {
            return;
        }

        $modifiers = $element;
        if (in_array($type, $this->selfRoundingTypes, true)) {
            unset($modifiers['radius']); // already applied by the shape itself
        }

        $this->layers->applyModifiers($rendered->layer, $modifiers);

        $canvas->compositeImage(
            $rendered->layer,
            Imagick::COMPOSITE_OVER,
            $rendered->x,
            $rendered->y
        );

        $rendered->layer->clear();
        $rendered->layer->destroy();
    }
}
