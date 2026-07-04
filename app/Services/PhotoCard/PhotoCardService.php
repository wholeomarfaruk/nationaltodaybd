<?php

namespace App\Services\PhotoCard;

use App\Models\PhotoCardFieldMap;
use App\Models\PhotoCardTemplate;
use App\Models\Post;
use Imagick;
use ImagickPixel;

/**
 * Single entry point for photocard generation. Resolves the template + field
 * data, builds the canvas, renders every element, writes the PNG, and prunes
 * old output. Container-bound so callers just do:
 *
 *   app(PhotoCardService::class)->generateForPost($post, $slug);
 */
class PhotoCardService
{
    /** Keep at most this many generated cards on disk. */
    protected int $keepFiles = 50;

    public function __construct(
        protected TemplateResolver $templates,
        protected FieldResolver $fields,
        protected ImageRenderer $renderer,
    ) {}

    /**
     * Generate a card for a post using a template slug. Returns absolute path.
     */
    public function generateForPost(Post $post, string $templateSlug): string
    {
        $template = $this->templates->loadModel($templateSlug);
        $config = $template->config;

        $fieldMaps = PhotoCardFieldMap::where('photocard_template_id', $template->id)->get();
        $data = $this->fields->resolve($post, $fieldMaps, $config['date_format'] ?? null);

        $this->templates->validate($config, $data);

        return $this->renderToFile($config, $data);
    }

    /**
     * Render an arbitrary config + data array to a PNG file. Reusable by the
     * preview generator.
     */
    public function renderToFile(array $config, array $data, ?string $outputPath = null): string
    {
        if (!extension_loaded('imagick')) {
            throw new \RuntimeException('Imagick extension not installed');
        }

        $canvas = $this->makeCanvas($config);

        foreach ($config['elements'] ?? [] as $element) {
            try {
                $this->renderer->renderElement($canvas, $element, $data);
            } catch (\Throwable $e) {
                \Log::warning('PhotoCard element render failed', [
                    'type' => $element['type'] ?? 'unknown',
                    'error' => $e->getMessage(),
                ]);
            }
        }

        $outputPath ??= $this->defaultOutputPath();
        $this->ensureDir(dirname($outputPath));

        // Flatten onto the solid canvas background. The card is always opaque,
        // and flattening avoids alpha-composite artefacts from source images
        // that lack their own alpha channel (e.g. JPEG featured images).
        $flat = new Imagick();
        $flat->newImage(
            $canvas->getImageWidth(),
            $canvas->getImageHeight(),
            new ImagickPixel($config['canvas']['background'] ?? '#ffffff')
        );
        $flat->compositeImage($canvas, Imagick::COMPOSITE_OVER, 0, 0);
        $flat->setImageFormat('png');
        $flat->writeImage($outputPath);
        $flat->clear();
        $flat->destroy();

        $canvas->clear();
        $canvas->destroy();

        $this->pruneOldFiles();

        return $outputPath;
    }

    protected function makeCanvas(array $config): Imagick
    {
        $canvas = new Imagick();
        $canvas->newImage(
            (int) ($config['canvas']['width'] ?? 1080),
            (int) ($config['canvas']['height'] ?? 1080),
            new ImagickPixel($config['canvas']['background'] ?? '#ffffff')
        );
        $canvas->setImageFormat('png');
        $canvas->setImageAlphaChannel(Imagick::ALPHACHANNEL_ACTIVATE);

        return $canvas;
    }

    protected function defaultOutputPath(): string
    {
        return public_path('photocards/' . uniqid('photocard_') . '.png');
    }

    protected function ensureDir(string $dir): void
    {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }

    /**
     * Keep the output directory bounded (previews subdir is excluded).
     */
    protected function pruneOldFiles(): void
    {
        $dir = public_path('photocards');
        $files = glob($dir . '/photocard_*.png') ?: [];

        if (count($files) <= $this->keepFiles) {
            return;
        }

        usort($files, fn($a, $b) => filemtime($a) <=> filemtime($b));
        foreach (array_slice($files, 0, count($files) - $this->keepFiles) as $old) {
            @unlink($old);
        }
    }
}
