<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\VideoPost as Video;

class ShortsPage extends Component
{
    public $videos;
    public $currentIndex = 0;
    public $currentSlug;
    public $search = '';

    public function mount($video)
    {
        $this->videos = Video::where('type', 'shorts')
            ->when($this->search, fn($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->orderBy('id', 'desc')
            ->get()
            ->values();

        if ($video) {
            $this->currentIndex = $this->videos->search(fn($v) => $v->id===$video->id) ?? 0;
        }

        $this->currentSlug = $this->videos[$this->currentIndex]->slug ?? null;
    }

    public function nextVideo()
    {
        if ($this->currentIndex < count($this->videos) - 1) {
            $this->currentIndex++;
            $this->updateSlug();
        }
    }

    public function prevVideo()
    {
        if ($this->currentIndex > 0) {
            $this->currentIndex--;
            $this->updateSlug();
        }
    }

    public function updateSlug()
    {
        $this->currentSlug = $this->videos[$this->currentIndex]->slug;
        $this->dispatch('update-url', $this->currentSlug);
    }

    public function updatedSearch()
    {
        $this->mount();
    }

    public function render()
    {
        return view('livewire.shorts-page');
    }
}
