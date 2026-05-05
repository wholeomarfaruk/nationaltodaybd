<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
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

        return view('livewire.post-list', [
            'posts' => $posts,
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
}
