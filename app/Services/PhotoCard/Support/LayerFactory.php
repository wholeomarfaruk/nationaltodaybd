<?php

namespace App\Services\PhotoCard\Support;

use Imagick;
use ImagickDraw;
use ImagickPixel;

/**
 * Creates transparent Imagick layers and applies element-level modifiers
 * (opacity, radius, border, shadow) to a SINGLE layer.
 *
 * This is the fix for the original whole-canvas bugs: modifiers used to be
 * applied to the shared canvas (fading / rounding EVERYTHING). Now each
 * element is drawn onto its own transparent layer, modified in isolation,
 * and only then composited onto the canvas.
 */
class LayerFactory
{
    /**
     * A new fully transparent RGBA layer of the given size.
     */
    public function newLayer(int $width, int $height): Imagick
    {
        $layer = new Imagick();
        $layer->newImage($width, $height, new ImagickPixel('transparent'));
        $layer->setImageFormat('png');
        $layer->setImageAlphaChannel(Imagick::ALPHACHANNEL_ACTIVATE);

        return $layer;
    }

    /**
     * Apply per-element modifiers to a finished layer, in a sensible order:
     * radius (clip) → border (stroke the clipped shape) → shadow → opacity.
     */
    public function applyModifiers(Imagick $layer, array $element): void
    {
        if (!empty($element['radius'])) {
            $this->applyRadius($layer, (int) $element['radius']);
        }

        if (!empty($element['border'])) {
            $this->applyBorder($layer, $element['border']);
        }

        if (!empty($element['shadow'])) {
            $this->applyShadow($layer, $element['shadow']);
        }

        if (isset($element['opacity']) && $element['opacity'] < 1) {
            $this->applyOpacity($layer, (float) $element['opacity']);
        }
    }

    /**
     * Round the corners of THIS layer only.
     */
    protected function applyRadius(Imagick $layer, int $radius): void
    {
        $radius = min(
            $radius,
            (int) ($layer->getImageWidth() / 2),
            (int) ($layer->getImageHeight() / 2)
        );

        if ($radius <= 0) {
            return;
        }

        // Build a rounded-rect alpha mask and intersect it with the layer.
        $mask = new Imagick();
        $mask->newImage(
            $layer->getImageWidth(),
            $layer->getImageHeight(),
            new ImagickPixel('transparent')
        );
        $mask->setImageFormat('png');

        $draw = new ImagickDraw();
        $draw->setFillColor(new ImagickPixel('white'));
        $draw->roundRectangle(
            0,
            0,
            $layer->getImageWidth() - 1,
            $layer->getImageHeight() - 1,
            $radius,
            $radius
        );
        $mask->drawImage($draw);

        $layer->compositeImage($mask, Imagick::COMPOSITE_DSTIN, 0, 0);
        $mask->clear();
        $mask->destroy();
    }

    /**
     * Stroke a border around the layer edge (follows rounded corners).
     */
    protected function applyBorder(Imagick $layer, array $border): void
    {
        $width = (int) ($border['width'] ?? 2);
        $color = $border['color'] ?? '#000000';
        $radius = (int) ($border['radius'] ?? 0);

        $draw = new ImagickDraw();
        $draw->setStrokeColor(new ImagickPixel($color));
        $draw->setStrokeWidth($width);
        $draw->setFillOpacity(0);

        $inset = (int) ceil($width / 2);
        $x1 = $inset;
        $y1 = $inset;
        $x2 = $layer->getImageWidth() - 1 - $inset;
        $y2 = $layer->getImageHeight() - 1 - $inset;

        if ($radius > 0) {
            $draw->roundRectangle($x1, $y1, $x2, $y2, $radius, $radius);
        } else {
            $draw->rectangle($x1, $y1, $x2, $y2);
        }

        $layer->drawImage($draw);
    }

    /**
     * Composite a soft drop shadow BEHIND the layer content, expanding the
     * layer canvas so the shadow isn't clipped.
     */
    protected function applyShadow(Imagick $layer, array $shadow): void
    {
        $color = $shadow['color'] ?? '#000000';
        $blur = (float) ($shadow['blur'] ?? 5);
        $opacity = (float) ($shadow['opacity'] ?? 0.5);
        $offsetX = (int) ($shadow['x'] ?? 0);
        $offsetY = (int) ($shadow['y'] ?? 4);

        $shadowLayer = clone $layer;
        $shadowLayer->setImageBackgroundColor(new ImagickPixel($color));

        // shadowImage(opacity%, sigma, x, y) builds a shadow from alpha.
        $shadowLayer->shadowImage((int) round($opacity * 100), $blur, 0, 0);

        // Paint the shadow underneath the original content.
        $shadowLayer->compositeImage($layer, Imagick::COMPOSITE_OVER, $offsetX, $offsetY);

        $layer->clear();
        $layer->addImage($shadowLayer);
        $shadowLayer->clear();
        $shadowLayer->destroy();
    }

    /**
     * Fade THIS layer's alpha only.
     */
    protected function applyOpacity(Imagick $layer, float $opacity): void
    {
        $opacity = max(0, min(1, $opacity));
        $layer->evaluateImage(Imagick::EVALUATE_MULTIPLY, $opacity, Imagick::CHANNEL_ALPHA);
    }
}
