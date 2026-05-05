<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class postSection extends Component
{
    /**
     * Create a new component instance.
     */
    public $newsPosts;
    public $style;
    public function __construct($newsPosts,$style='5')
    {
        $this->newsPosts=$newsPosts;
        $this->style=$style;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post-section');
    }
}
