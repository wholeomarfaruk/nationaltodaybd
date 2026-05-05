<?php

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Component;


class SettingSocial extends Component
{
    public $facebook, $twitter, $instagram, $linkedin, $tiktok, $youtube, $whatsapp, $telegram;

    public function mount()
    {
         $general = Setting::where('key', 'social')->value('value') ?? [];

        if (is_string($general)) {
            $general = json_decode($general, true);
        }

        $this->facebook = data_get($general, 'facebook');
        $this->twitter = data_get($general, 'twitter');
        $this->instagram = data_get($general, 'instagram');
        $this->linkedin = data_get($general, 'linkedin');
        $this->tiktok = data_get($general, 'tiktok');
        $this->youtube = data_get($general, 'youtube');
        $this->whatsapp = data_get($general, 'whatsapp');
        $this->telegram = data_get($general, 'telegram');
        // dd($general);
    }
    public function render()
    {
        return view('livewire.setting-social');
    }
    public function updateSetting(){
         $settings = [
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'tiktok' => $this->tiktok,
            'youtube' => $this->youtube,
            'whatsapp' => $this->whatsapp,
            'telegram' => $this->telegram
        ];

        // dd($settings);

        Setting::where('key', 'social')->update(['value' => json_encode($settings)]);


        cache()->forget('settings');
        $this->dispatch('toast', ['type' => 'success', 'message' => 'Settings updated successfully!']);

    }
}
