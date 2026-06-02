<?php

namespace App\Livewire;

use App\Models\PhotoCardFieldMap;
use App\Models\PhotoCardTemplate;
use App\Models\Post;
use App\Services\PhotoCard\FieldResolver;
use App\Services\PhotoCard\PhotoCardGenerator;
use App\Services\PhotoCard\TemplateResolver;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    public $search = '';

    public function mount()
    {
        // Logic to retrieve posts from the database or any other source
    }

    public function render()
    {
        if (!empty($this->search)) {
            $posts = Post::where('title', 'like', '%' . $this->search . '%')
                ->latest()->paginate(10);
        } else {
            $posts = Post::latest()->paginate(10);
        }

        $activeTemplates = PhotoCardTemplate::where('is_active', true)
            ->get(['id', 'name', 'slug']);

        return view('livewire.post-list', [
            'posts' => $posts,
            'activeTemplates' => $activeTemplates,
        ]);
    }
    public function deletePost($id)
    {
        $post = Post::find($id);
        if (!$post) {
            $this->dispatch('deletePost', ['error' => true]);
            return;
        }
        $media = $post->media->where('category', 'featured_image')->first();
        if ($media) {
            if (file_exists(public_path('uploads/' . $media->path))) {

                unlink(public_path('uploads/' . $media->path));
            }
        }
        $post->delete();
        $this->dispatch('deletePost', ['success' => true]);
    }

    public function generatePhotoCard($postId, $templateSlug)
    {
        try {
            \Log::info("=== Photocard Generation Started ===");
            \Log::info("Post ID: $postId, Template Slug: $templateSlug");

            $post = Post::with('media', 'category')->findOrFail($postId);
            \Log::info("✓ Post loaded", ['post_id' => $post->id, 'title' => $post->title]);

            $templateResolver = new TemplateResolver();
            \Log::info("✓ TemplateResolver created");

            $template = $templateResolver->load($templateSlug);
            \Log::info("✓ Template loaded", ['slug' => $templateSlug, 'config_keys' => array_keys($template)]);

            $templateId = PhotoCardTemplate::where('slug', $templateSlug)->firstOrFail()->id;
            \Log::info("✓ Template ID found: $templateId");

            $fieldMaps = PhotoCardFieldMap::where('photocard_template_id', $templateId)->get();
            \Log::info("✓ Field maps loaded", ['count' => $fieldMaps->count()]);

            $fieldResolver = new FieldResolver();
            \Log::info("✓ FieldResolver created");

            $data = $fieldResolver->resolve($post, $fieldMaps);
            \Log::info("✓ Data resolved", ['keys' => array_keys($data), 'data' => array_map(fn($v) => is_string($v) && strlen($v) > 100 ? substr($v, 0, 100) . '...' : $v, $data)]);

            $templateResolver->validate($template, $data);
            \Log::info("✓ Data validated against template");

            $imageRenderer = new \App\Services\PhotoCard\ImageRenderer();
            \Log::info("✓ ImageRenderer created");

            $generator = new PhotoCardGenerator($templateResolver, $imageRenderer);
            \Log::info("✓ PhotoCardGenerator created");

            $filePath = $generator->generate($template, $data);
            \Log::info("✓ Image generated", ['path' => $filePath, 'exists' => file_exists($filePath), 'size' => filesize($filePath) ?? 'N/A']);

            $filename = basename($filePath);
            \Log::info("✓ Filename extracted: $filename");

            // Dispatch events to browser
            $this->dispatch('download-photocard', filename: $filename);
            \Log::info("✓ Download event dispatched");

            $this->dispatch('photocardGenerated', success: true);
            \Log::info("=== Photocard Generation Completed Successfully ===");
        } catch (\Exception $e) {
            \Log::error('❌ Photocard generation failed', [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            $this->dispatch('photocardGenerationFailed', ['error' => $e->getMessage()]);
        }
    }
}
