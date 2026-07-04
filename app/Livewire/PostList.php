<?php

namespace App\Livewire;

use App\Models\PhotoCardTemplate;
use App\Models\Post;
use App\Services\PhotoCard\PhotoCardService;
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
            $post = Post::with('media', 'category')->findOrFail($postId);

            $filePath = app(PhotoCardService::class)
                ->generateForPost($post, $templateSlug);

            $this->dispatch('download-photocard', filename: basename($filePath));
            $this->dispatch('photocardGenerated', success: true);
        } catch (\Throwable $e) {
            \Log::error('Photocard generation failed', [
                'post_id' => $postId,
                'template' => $templateSlug,
                'error' => $e->getMessage(),
                'file' => $e->getFile() . ':' . $e->getLine(),
            ]);
            $this->dispatch('photocardGenerationFailed', ['error' => $e->getMessage()]);
        }
    }
}
