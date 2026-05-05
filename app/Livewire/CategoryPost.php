<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;

class CategoryPost extends Component
{
    public $perPage = 6;        // number of posts per load
    public $page = 1;           // current page
    public $allPosts;           // store already loaded posts
    public $totalcount;         // total posts in category
    public $totalloaded;        // currently loaded posts
    public $category_id;

    public function mount($category_id)
    {
        $this->category_id = $category_id;
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
        $category = Category::where('id', $this->category_id)->firstOrFail();

        // total posts in this category
        $this->totalcount = Post::where('category_id', $this->category_id)->count();

        $offset = ($this->page - 1) * $this->perPage;

        $newPosts = Post::where('category_id', $category->id)
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
        return view('livewire.category-post', [
            'posts' => $this->allPosts,
            'total' => $this->totalcount,
            'loaded' => $this->totalloaded
        ]);
    }
}
