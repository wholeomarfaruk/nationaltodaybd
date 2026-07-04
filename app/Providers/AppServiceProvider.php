<?php

namespace App\Providers;

use App\Services\PhotoCard\Elements\BadgeElement;
use App\Services\PhotoCard\Elements\CircleElement;
use App\Services\PhotoCard\Elements\GradientElement;
use App\Services\PhotoCard\Elements\ImageElement;
use App\Services\PhotoCard\Elements\LineElement;
use App\Services\PhotoCard\Elements\RectangleElement;
use App\Services\PhotoCard\Elements\TextElement;
use App\Services\PhotoCard\ImageRenderer;
use App\Services\PhotoCard\Support\LayerFactory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // The rendering engine needs its element renderers wired up. All the
        // support/collaborator classes are plain constructor-injectable, so
        // only ImageRenderer needs an explicit binding for its renderer list.
        $this->app->singleton(ImageRenderer::class, function ($app) {
            $layers = $app->make(LayerFactory::class);

            return new ImageRenderer($layers, [
                $app->make(ImageElement::class),
                $app->make(TextElement::class),
                $app->make(RectangleElement::class),
                $app->make(GradientElement::class),
                $app->make(LineElement::class),
                $app->make(CircleElement::class),
                $app->make(BadgeElement::class),
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
