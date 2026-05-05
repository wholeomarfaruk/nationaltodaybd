<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;
class PostDetail extends Component
{
    public $currentpost;
    public $relatedPosts;
    public $recentPosts;
    public $nextPost;
    public $allPosts;
    public $lastId;
    public function mount($id)
    {
        $firstPost = Post::findOrFail($id);

        $this->currentpost = $firstPost;
        $this->allPosts = collect([$firstPost]);
        $this->lastId = $firstPost->id;

        $this->relatedPosts = Post::where('category_id', $firstPost->category_id)
            ->where('id', '!=', $firstPost->id)
            ->latest()
            ->take(5)
            ->get();

        $this->recentPosts = Post::latest()
            ->take(10)
            ->get();

        $this->prepareNextPost();
        // Dispatch the event to re-parse Facebook widgets
    }

    public function prepareNextPost()
    {
        $this->nextPost = Post::where('id', '>', $this->lastId)
            ->orderBy('id', 'asc')
            ->first();
    }

    public function loadNextPost()
    {
        if ($this->nextPost) {
            $this->allPosts->push($this->nextPost);

            // Set current post and increment views
            $this->currentpost = $this->nextPost;
            $this->currentpost->increment('views');

            // Reload related posts
            $this->relatedPosts = Post::where('category_id', $this->currentpost->category_id)
                ->where('id', '!=', $this->currentpost->id)
                ->latest()
                ->take(5)
                ->get();

            // Reload recent posts
            $this->recentPosts = Post::latest()
                ->take(10)
                ->get();
             $this->dispatch('fb-reinit');


            // Update lastId and prepare next post
            $this->lastId = $this->currentpost->id;
            $this->prepareNextPost();
            $this->dispatch('post-loaded');


        }
    }


    public function render()
    {
        return view('livewire.post-detail');
    }
}
