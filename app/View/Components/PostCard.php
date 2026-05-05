<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $type;
    public $title;
    public $excerpt;
    public $image;
    public $author;
    public $link;
    public function __construct($title, $excerpt, $image, $link,$author, $type = 'default')
    {

    $this->title = $title;
    $this->excerpt = $excerpt;
    $this->image = $image;
    $this->link = $link;
    $this->author = $author;
    $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post-card');
    }
}
