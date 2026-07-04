<?php

namespace App\Services\PhotoCard\Elements;

use Imagick;
use ImagickDraw;
use ImagickPixel;

class TextElement extends AbstractElement
{
    public function type(): string
    {
        return 'text';
    }

    public function render(Imagick $canvas, array $element, array $data): ?RenderedLayer
    {
        $text = $this->resolveText($element, $data);
        if ($text === '') {
            return null;
        }

        $draw = $this->makeDraw($element);

        $size = (int) ($element['size'] ?? 32);
        $align = $element['align'] ?? 'left';
        $lineHeight = (int) ($element['line_height'] ?? $size * 1.2);
        $maxWidth = isset($element['max_width']) ? (int) $element['max_width'] : null;
        $maxLines = isset($element['max_lines']) ? (int) $element['max_lines'] : null;

        // Determine the lines + the layer width.
        if ($maxWidth) {
            $lines = $this->wrapText($canvas, $draw, $text, $maxWidth);
            if ($maxLines && count($lines) > $maxLines) {
                $lines = array_slice($lines, 0, $maxLines);
                $lines[$maxLines - 1] = rtrim($lines[$maxLines - 1]) . '…';
            }
            $layerW = $maxWidth;
        } else {
            $lines = [$text];
            $metrics = $canvas->queryFontMetrics($draw, $text);
            $layerW = (int) ceil($metrics['textWidth']) + 4;
        }

        // Padding so descenders / shadows / strokes aren't clipped.
        $pad = max(6, (int) ($size * 0.35));
        $layerH = $lineHeight * count($lines) + $pad * 2;

        $layer = $this->layers->newLayer($layerW, $layerH);

        // Baseline of the first line inside the layer.
        $baseline = $pad + (int) ($size * 0.85);

        foreach ($lines as $i => $line) {
            $this->drawLine(
                $layer,
                $draw,
                $element,
                $line,
                $layerW,
                $align,
                $baseline + $i * $lineHeight
            );
        }

        $x = (int) ($element['x'] ?? 0);
        $y = (int) ($element['y'] ?? 0);
        if (!empty($element['center_x'])) {
            $x = (int) (($canvas->getImageWidth() - $layerW) / 2);
        }

        // The template's y is the visual baseline of the first line; align the
        // layer so that baseline lands on it.
        return new RenderedLayer($layer, $x, $y - $baseline);
    }

    protected function resolveText(array $element, array $data): string
    {
        if (!empty($element['field'])) {
            return trim((string) ($data[$element['field']] ?? ''));
        }

        if (!empty($element['value'])) {
            return trim($this->replaceVariables($element['value'], $data));
        }

        return '';
    }

    protected function makeDraw(array $element): ImagickDraw
    {
        $draw = new ImagickDraw();

        $fontPath = public_path($element['font'] ?? '');
        if ($fontPath && is_file($fontPath)) {
            $draw->setFont($fontPath);
        }

        $draw->setFontSize((int) ($element['size'] ?? 32));
        $draw->setFillColor(new ImagickPixel($element['color'] ?? '#000000'));

        return $draw;
    }

    protected function drawLine(
        Imagick $layer,
        ImagickDraw $draw,
        array $element,
        string $text,
        int $boxWidth,
        string $align,
        int $baselineY
    ): void {
        $metrics = $layer->queryFontMetrics($draw, $text);
        $textWidth = $metrics['textWidth'] ?? 0;

        $x = match ($align) {
            'center' => ($boxWidth - $textWidth) / 2,
            'right' => $boxWidth - $textWidth,
            default => 0,
        };

        // Text shadow first (behind).
        if (!empty($element['text_shadow'])) {
            $this->drawShadow($layer, $draw, $element['text_shadow'], $text, $x, $baselineY);
        }

        // Optional stroke outline.
        if (!empty($element['stroke'])) {
            $draw->setStrokeColor(new ImagickPixel($element['stroke']['color'] ?? '#000000'));
            $draw->setStrokeWidth((float) ($element['stroke']['width'] ?? 1));
        }

        $layer->annotateImage($draw, $x, $baselineY, 0, $text);
    }

    protected function drawShadow(
        Imagick $layer,
        ImagickDraw $draw,
        array $shadow,
        string $text,
        float $x,
        float $baselineY
    ): void {
        $color = $shadow['color'] ?? '#000000';
        $opacity = (float) ($shadow['opacity'] ?? 0.5);
        $dx = (float) ($shadow['x'] ?? 2);
        $dy = (float) ($shadow['y'] ?? 2);
        $blur = (float) ($shadow['blur'] ?? 0);

        $shadowDraw = clone $draw;
        $shadowDraw->setFillColor(new ImagickPixel($color));
        $shadowDraw->setStrokeColor(new ImagickPixel($color));

        if ($blur > 0) {
            $tmp = new Imagick();
            $tmp->newImage($layer->getImageWidth(), $layer->getImageHeight(), new ImagickPixel('transparent'));
            $tmp->setImageFormat('png');
            $tmp->annotateImage($shadowDraw, $x + $dx, $baselineY + $dy, 0, $text);
            $tmp->blurImage($blur, $blur);
            $tmp->evaluateImage(Imagick::EVALUATE_MULTIPLY, $opacity, Imagick::CHANNEL_ALPHA);
            $layer->compositeImage($tmp, Imagick::COMPOSITE_OVER, 0, 0);
            $tmp->clear();
            $tmp->destroy();
        } else {
            $shadowDraw->setFillOpacity($opacity);
            $layer->annotateImage($shadowDraw, $x + $dx, $baselineY + $dy, 0, $text);
        }
    }

    protected function wrapText(Imagick $canvas, ImagickDraw $draw, string $text, int $maxWidth): array
    {
        $lines = [];
        $words = preg_split('/(\s+)/u', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
        $current = '';

        foreach ($words as $word) {
            if ($word === '') {
                continue;
            }

            $test = $current . $word;
            $metrics = $canvas->queryFontMetrics($draw, $test);

            if (($metrics['textWidth'] ?? 0) > $maxWidth && $current !== '') {
                $lines[] = trim($current);
                $current = ltrim($word);
            } else {
                $current = $test;
            }
        }

        if (trim($current) !== '') {
            $lines[] = trim($current);
        }

        return $lines ?: [''];
    }

    protected function replaceVariables(string $text, array $data): string
    {
        foreach ($data as $key => $value) {
            $text = str_replace('{' . $key . '}', (string) $value, $text);
        }

        return $text;
    }
}
