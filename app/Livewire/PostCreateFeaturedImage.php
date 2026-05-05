<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\Features\SupportFileUploads\WithFileUploads;

class PostCreateFeaturedImage extends Component
{
    use WithFileUploads;
    public $featured_image;
    public function render()
    {
        return view('livewire.post-create-featured-image');
    }

}
