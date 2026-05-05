<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class RecentPost extends Component
{

    public $perPage = 6;        // number of posts per load
    public $page = 1;           // current page
    public $allPosts;           // store already loaded posts
    public $totalcount;         // total posts in category
    public $totalloaded;        // currently loaded posts
    public $category_id;

    public function mount()
    {

        $this->allPosts = collect();
        $this->loadPosts();
    }

    public function loadMore()
    {
        $this->page++;
        $this->loadPosts();
    }

    private function loadPosts()
    {

        // total posts in this category
        $this->totalcount = Post::where('status','published')->count();

        $offset = ($this->page - 1) * $this->perPage;

        $newPosts = Post::where('status','published')
            ->latest()
            ->skip($offset)
            ->take($this->perPage)
            ->get();

        // append new posts
        $this->allPosts = $this->allPosts->merge($newPosts);

        // currently loaded posts
        $this->totalloaded = $this->allPosts->count();
    }

    public function render()
    {
        return view('livewire.recent-post', [
            'posts' => $this->allPosts,
            'total' => $this->totalcount,
            'loaded' => $this->totalloaded
        ]);
    }
}
