<?php

namespace App\Services\PhotoCard;

use Exception;
use Imagick;
use ImagickDraw;
use ImagickPixel;

class ImageRenderer
{
    private Imagick $elementLayer;

    public function render(
        Imagick $canvas,
        array $element,
        array $data
    ): void {

        $element = $this->applyAutoCenter(
            $canvas,
            $element
        );

        switch ($element['type'] ?? null) {

            case 'image':
                $this->renderImage($canvas, $element, $data);
                $this->applyElementModifiers($canvas, $element);
                break;

            case 'text':
                $this->renderText($canvas, $element, $data);
                break;

            case 'rectangle':
                $this->renderRectangle($canvas, $element);
                $this->applyElementModifiers($canvas, $element);
                break;
        }
    }

    protected function applyAutoCenter(
        Imagick $canvas,
        array $element
    ): array {

        $canvasWidth = $canvas->getImageWidth();
        $canvasHeight = $canvas->getImageHeight();

        if (!empty($element['center_x'])) {
            if ($element['type'] === 'text') {
                $element['align'] = 'center';
                $maxWidth = $element['max_width'] ?? $canvasWidth;
                $element['x'] = (int)(
                    ($canvasWidth - $maxWidth) / 2
                );
            } else {
                $element['x'] = (int)(
                    ($canvasWidth - $element['w']) / 2
                );
            }
        }

        if (!empty($element['center_y'])) {
            $element['y'] = (int)(
                ($canvasHeight - $element['h']) / 2
            );
        }

        return $element;
    }

    protected function applyElementModifiers(
        Imagick $canvas,
        array $element
    ): void {

        if (!empty($element['opacity'])) {
            $this->applyOpacity($canvas, $element['opacity']);
        }

        if (!empty($element['border'])) {
            $this->applyBorder($canvas, $element);
        }

        if (!empty($element['shadow'])) {
            $this->applyShadow($canvas, $element['shadow']);
        }

        if (!empty($element['radius'])) {
            $this->applyBorderRadius($canvas, $element);
        }
    }

    protected function renderImage(
        Imagick $canvas,
        array $element,
        array $data
    ): void {

        $field = $element['field'] ?? null;

        if (!$field || empty($data[$field])) {
            return;
        }

        $this->compositeImage(
            $canvas,
            $element,
            $data[$field]
        );
    }

    protected function renderText(
        Imagick $canvas,
        array $element,
        array $data
    ): void {

        $text = '';

        if (!empty($element['field'])) {

            $text = $data[$element['field']] ?? '';

        } elseif (!empty($element['value'])) {

            $text = $element['value'];
            $text = $this->replaceVariables($text, $data);
        }

        if (!$text) {
            return;
        }

        $draw = new ImagickDraw();

        $fontPath = public_path($element['font']);

        if (file_exists($fontPath)) {
            $draw->setFont($fontPath);
        }

        $draw->setFontSize($element['size']);
        $draw->setFillColor(
            new ImagickPixel($element['color'])
        );

        if (!empty($element['stroke'])) {
            $draw->setStrokeColor(
                new ImagickPixel(
                    $element['stroke']['color']
                )
            );
            $draw->setStrokeWidth(
                $element['stroke']['width'] ?? 1
            );
        }

        $maxWidth = $element['max_width'] ?? null;
        $align = $element['align'] ?? 'left';
        $lineHeight = $element['line_height']
            ?? ($element['size'] * 1.2);

        $maxLines = $element['max_lines'] ?? null;

        if ($maxWidth) {

            $lines = $this->wrapText(
                $canvas,
                $draw,
                $text,
                $maxWidth
            );

            if ($maxLines && count($lines) > $maxLines) {

                $lines = array_slice(
                    $lines,
                    0,
                    $maxLines
                );

                $lines[$maxLines - 1] .= '...';
            }

            $currentY = $element['y'];

            foreach ($lines as $line) {

                $this->drawSingleLine(
                    $canvas,
                    $draw,
                    $element['x'],
                    $currentY,
                    $line,
                    $maxWidth,
                    $align,
                    $element
                );

                $currentY += $lineHeight;
            }

        } else {

            $this->drawSingleLine(
                $canvas,
                $draw,
                $element['x'],
                $element['y'],
                $text,
                null,
                $align,
                $element
            );
        }

        if (!empty($element['opacity'])) {
            $this->applyOpacity($canvas, $element['opacity']);
        }
    }

    protected function renderRectangle(
        Imagick $canvas,
        array $element
    ): void {

        $draw = new ImagickDraw();

        $draw->setFillColor(
            new ImagickPixel(
                $element['fill'] ?? '#ffffff'
            )
        );

        $x = $element['x'];
        $y = $element['y'];
        $w = $element['w'];
        $h = $element['h'];
        $radius = $element['radius'] ?? 0;

        if ($radius > 0) {
            $this->drawRoundedRectangle(
                $draw,
                $x,
                $y,
                $x + $w,
                $y + $h,
                $radius
            );
        } else {
            $draw->rectangle(
                $x,
                $y,
                $x + $w,
                $y + $h
            );
        }

        $canvas->drawImage($draw);
    }

protected function drawSingleLine(
        Imagick $canvas,
        ImagickDraw $draw,
        int $x,
        int $y,
        string $text,
        ?int $maxWidth,
        string $align,
        array $element = []
    ): void {

        $finalX = $x;

        if ($maxWidth && $align !== 'left') {

            $metrics = $canvas->queryFontMetrics(
                $draw,
                $text
            );

            $textWidth =
                $metrics['textWidth'] ?? 0;

            if ($align === 'center') {

                $finalX =
                    $x +
                    (($maxWidth - $textWidth) / 2);

            } elseif ($align === 'right') {

                $finalX =
                    $x +
                    ($maxWidth - $textWidth);
            }
        }

        if (!empty($element['text_shadow'])) {
            $shadow = $element['text_shadow'];
            $shadowColor = $shadow['color'] ?? '#000000';
            $shadowOpacity = $shadow['opacity'] ?? 0.5;
            $shadowX = $shadow['x'] ?? 2;
            $shadowY = $shadow['y'] ?? 2;
            $shadowBlur = $shadow['blur'] ?? 0;

            $shadowDraw = clone $draw;
            $shadowDraw->setFillColor(
                new ImagickPixel($shadowColor)
            );
            $shadowDraw->setStrokeColor(
                new ImagickPixel($shadowColor)
            );

            if ($shadowBlur > 0) {
                $tempImage = new Imagick();
                $tempImage->newImage(
                    $canvas->getImageWidth(),
                    $canvas->getImageHeight(),
                    new ImagickPixel('transparent')
                );
                $tempImage->setImageFormat('png');

                $tempImage->annotateImage(
                    $shadowDraw,
                    $finalX + $shadowX,
                    $y + $shadowY,
                    0,
                    $text
                );

                $tempImage->blurImage(
                    $shadowBlur,
                    $shadowBlur
                );

                $tempImage->evaluateImage(
                    Imagick::EVALUATE_MULTIPLY,
                    $shadowOpacity,
                    Imagick::CHANNEL_ALPHA
                );

                $canvas->compositeImage(
                    $tempImage,
                    Imagick::COMPOSITE_OVER,
                    0,
                    0
                );

                $tempImage->clear();
            } else {
                $shadowDraw->setAlpha($shadowOpacity);

                $canvas->annotateImage(
                    $shadowDraw,
                    $finalX + $shadowX,
                    $y + $shadowY,
                    0,
                    $text
                );
            }
        }

        $canvas->annotateImage(
            $draw,
            $finalX,
            $y,
            0,
            $text
        );
    }

    protected function wrapText(
        Imagick $canvas,
        ImagickDraw $draw,
        string $text,
        int $maxWidth
    ): array {

        $lines = [];

        $words = preg_split(
            '/(\s+)/u',
            $text,
            -1,
            PREG_SPLIT_DELIM_CAPTURE
        );

        $currentLine = '';

        foreach ($words as $word) {

            if ($word === '') {
                continue;
            }

            $testLine =
                $currentLine . $word;

            $metrics =
                $canvas->queryFontMetrics(
                    $draw,
                    $testLine
                );

            $width =
                $metrics['textWidth'] ?? 0;

            if (
                $width > $maxWidth &&
                !empty($currentLine)
            ) {

                $lines[] = trim($currentLine);

                $currentLine = $word;

            } else {

                $currentLine = $testLine;
            }
        }

        if (!empty($currentLine)) {
            $lines[] = trim($currentLine);
        }

        return $lines;
    }

    protected function replaceVariables(
        string $text,
        array $data
    ): string {

        foreach ($data as $key => $value) {

            $text = str_replace(
                '{' . $key . '}',
                (string) $value,
                $text
            );
        }

        return $text;
    }

    public function compositeImage(
        Imagick $canvas,
        array $layout,
        string $path
    ): void {

        $fullPath =
            $this->normalizePath($path);

        if (!file_exists($fullPath)) {
            throw new Exception(
                "Image file not found: {$path}"
            );
        }

        $img = new Imagick($fullPath);

        $fit = $layout['fit'] ?? 'contain';
        $this->applyImageFit(
            $img,
            $layout['w'],
            $layout['h'],
            $fit
        );

        $canvas->compositeImage(
            $img,
            Imagick::COMPOSITE_OVER,
            $layout['x'],
            $layout['y']
        );

        $img->clear();
    }

    protected function applyImageFit(
        Imagick $img,
        int $targetW,
        int $targetH,
        string $fit
    ): void {

        $srcW = $img->getImageWidth();
        $srcH = $img->getImageHeight();

        match($fit) {
            'stretch' => $img->resizeImage(
                $targetW,
                $targetH,
                Imagick::FILTER_LANCZOS,
                1
            ),
            'cover' => $this->fitCover(
                $img,
                $targetW,
                $targetH
            ),
            'contain' => $this->fitContain(
                $img,
                $targetW,
                $targetH
            ),
            default => $img->resizeImage(
                $targetW,
                $targetH,
                Imagick::FILTER_LANCZOS,
                1
            ),
        };
    }

    protected function fitCover(
        Imagick $img,
        int $targetW,
        int $targetH
    ): void {

        $srcW = $img->getImageWidth();
        $srcH = $img->getImageHeight();

        $srcRatio = $srcW / $srcH;
        $targetRatio = $targetW / $targetH;

        if ($srcRatio > $targetRatio) {
            $newH = $targetH;
            $newW = (int)($newH * $srcRatio);
        } else {
            $newW = $targetW;
            $newH = (int)($newW / $srcRatio);
        }

        $img->resizeImage(
            $newW,
            $newH,
            Imagick::FILTER_LANCZOS,
            1
        );

        $offsetX = (int)(($newW - $targetW) / 2);
        $offsetY = (int)(($newH - $targetH) / 2);

        $img->cropImage(
            $targetW,
            $targetH,
            $offsetX,
            $offsetY
        );
    }

    protected function fitContain(
        Imagick $img,
        int $targetW,
        int $targetH
    ): void {

        $srcW = $img->getImageWidth();
        $srcH = $img->getImageHeight();

        $srcRatio = $srcW / $srcH;
        $targetRatio = $targetW / $targetH;

        if ($srcRatio > $targetRatio) {
            $newW = $targetW;
            $newH = (int)($newW / $srcRatio);
        } else {
            $newH = $targetH;
            $newW = (int)($newH * $srcRatio);
        }

        $img->resizeImage(
            $newW,
            $newH,
            Imagick::FILTER_LANCZOS,
            1
        );
    }

    protected function normalizePath(
        string $path
    ): string {

        if (
            str_starts_with(
                $path,
                public_path()
            )
        ) {
            return $path;
        }

        return public_path($path);
    }

    protected function applyOpacity(
        Imagick $canvas,
        float $opacity
    ): void {

        $opacity = max(0, min(1, $opacity));

        if ($opacity < 1) {
            $canvas->evaluateImage(
                Imagick::EVALUATE_MULTIPLY,
                $opacity,
                Imagick::CHANNEL_ALPHA
            );
        }
    }

    protected function applyBorder(
        Imagick $canvas,
        array $element
    ): void {

        $border = $element['border'];
        $width = $border['width'] ?? 2;
        $color = $border['color'] ?? '#000000';

        $draw = new ImagickDraw();
        $draw->setStrokeColor(
            new ImagickPixel($color)
        );
        $draw->setStrokeWidth($width);
        $draw->setFillOpacity(0);

        $x = $element['x'];
        $y = $element['y'];
        $w = $element['w'];
        $h = $element['h'];

        $draw->rectangle(
            $x,
            $y,
            $x + $w,
            $y + $h
        );

        $canvas->drawImage($draw);
    }

    protected function applyShadow(
        Imagick $canvas,
        array $shadow
    ): void {
        $this->applyShadowToImage($canvas, $shadow);
    }

    protected function applyShadowToImage(
        Imagick $image,
        array $shadow
    ): void {

        $shadowColor = $shadow['color'] ?? '#000000';
        $shadowBlur = $shadow['blur'] ?? 5;
        $shadowOpacity = $shadow['opacity'] ?? 0.5;
        $shadowX = $shadow['x'] ?? 3;
        $shadowY = $shadow['y'] ?? 3;

        $clone = clone $image;

        $clone->evaluateImage(
            Imagick::EVALUATE_MULTIPLY,
            $shadowOpacity,
            Imagick::CHANNEL_ALPHA
        );

        $clone->colorizeImage(
            new ImagickPixel($shadowColor),
            $shadowOpacity
        );

        $clone->blurImage(
            $shadowBlur,
            $shadowBlur
        );

        $image->compositeImage(
            $clone,
            Imagick::COMPOSITE_OVER,
            $shadowX,
            $shadowY
        );

        $clone->clear();
    }

    protected function applyBorderRadius(
        Imagick $canvas,
        array $element
    ): void {

        $radius = $element['radius'] ?? 0;

        if ($radius > 0) {
            try {
                $canvas->roundCornerImage(
                    $radius,
                    $radius
                );
            } catch (\Throwable $e) {
                \Log::warning(
                    'Border radius failed: ' .
                    $e->getMessage()
                );
            }
        }
    }

    protected function drawRoundedRectangle(
        ImagickDraw $draw,
        int $x1,
        int $y1,
        int $x2,
        int $y2,
        int $radius
    ): void {

        $radius = min(
            $radius,
            (int)(($x2 - $x1) / 2),
            (int)(($y2 - $y1) / 2)
        );

        $draw->pathStart();

        $draw->pathMoveToAbsolute($x1 + $radius, $y1);

        $draw->pathLineToAbsolute($x2 - $radius, $y1);

        $draw->pathCurveToQuadraticBezierAbsolute(
            $x2,
            $y1,
            $x2,
            $y1 + $radius
        );

        $draw->pathLineToAbsolute($x2, $y2 - $radius);

        $draw->pathCurveToQuadraticBezierAbsolute(
            $x2,
            $y2,
            $x2 - $radius,
            $y2
        );

        $draw->pathLineToAbsolute($x1 + $radius, $y2);

        $draw->pathCurveToQuadraticBezierAbsolute(
            $x1,
            $y2,
            $x1,
            $y2 - $radius
        );

        $draw->pathLineToAbsolute($x1, $y1 + $radius);

        $draw->pathCurveToQuadraticBezierAbsolute(
            $x1,
            $y1,
            $x1 + $radius,
            $y1
        );

        $draw->pathFinish();
    }
}
