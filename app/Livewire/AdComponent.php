<?php

namespace App\Livewire;

use App\Models\Ad;
use Livewire\Component;

class AdComponent extends Component
{
    public $ad;
    public $height;
    public function mount($id = 1, $height = null)
    {
        $this->height = $height;
        $id = $id ?? 1;

        $this->ad = $ad = Ad::find($id);
        
        if (!$this->ad) {
            return;
        }
        if ($this->ad && !$this->ad->status != 1) {
            $id = 1;
        }
        if (date('Y-m-d', strtotime($this->ad->expire_at)) < date('Y-m-d')) {
            $id = 1;
        }
        if (!$this->ad?->media()?->where('category', 'image')?->first() || !file_exists(public_path($this->ad?->media()?->where('category', 'image')?->first()?->path))) {
            return;
        }

        $this->ad = Ad::find($id);
    }
    public function render()
    {
        if (!$this->ad || ($this->ad && $this->ad->media->isEmpty())) {
            $this->ad = null;
        }

        return view('livewire.ad-component');
    }
}
