<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class LatestNewsTab extends Component
{
    public function render()
    {
        $LNPosts = Post::latest()->take(10)->get();
        $PNPosts = Post::orderBy('views', 'desc')->take(10)->get();

        return view('livewire.latest-news-tab',[
            'LNPosts'=>$LNPosts,
            'PNPosts'=>$PNPosts,
        ]);
    }
}
