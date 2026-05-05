<?php

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;

use function PHPUnit\Framework\directoryExists;

class SettingGeneral extends Component
{
    use WithFileUploads;
    public $site_title, $site_tagline, $logo, $old_logo, $favicon, $old_favicon, $logo_dark, $old_logo_dark,$email,$phone,$secondary_phone,$address,$footer_text;
    public function mount()
    {
        $general = Setting::where('key', 'general')->value('value') ?? [];

        if (is_string($general)) {
            $general = json_decode($general, true);
        }
        $this->site_title = data_get($general, 'site_title', '');
        $this->site_tagline = data_get($general, 'site_tagline', '');
        $this->old_logo = data_get($general, 'logo');
        $this->old_favicon = data_get($general, 'favicon');
        $this->old_logo_dark = data_get($general, 'logo_dark');
        $this->email = data_get($general, 'email');
        $this->phone = data_get($general, 'phone');
        $this->secondary_phone = data_get($general, 'secondary_phone');
        $this->address = data_get($general, 'address');
        $this->footer_text = data_get($general, 'footer_text');

        // dd($general);
    }

    public function render()
    {
        return view('livewire.setting-general');
    }
    public function updateSetting()
    {
        $this->validate([
            'site_title' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,ico|max:2048',
        ]);
        //logo
        if ($this->logo) {
            $dir = public_path('uploads/logo/');
            if (isset($this->old_logo) && file_exists(public_path($this->old_logo))) {
                unlink(public_path($this->old_logo));
            }


            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }
            $this->old_logo = "uploads/logo/logo." . $this->logo->extension();
            copy($this->logo->getRealPath(), public_path('uploads/logo/logo.' . $this->logo->extension()));
        }

        //favicon
        if ($this->favicon) {
            $dir = public_path('uploads/logo/');
            if (isset($this->old_favicon) && file_exists(public_path($this->old_favicon))) {
                unlink(public_path($this->old_favicon));
            }


            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }
            $this->old_favicon = "uploads/logo/favicon." . $this->favicon->extension();
            copy($this->favicon->getRealPath(), public_path('uploads/logo/favicon.' . $this->favicon->extension()));
        }
        $settings = [
            'site_title' => $this->site_title ?? '',
            'site_tagline' => $this->site_tagline ?? '',
            'logo' => $this->old_logo ?? '',
            'favicon' => $this->old_favicon ?? '',
            'email' => $this->email ?? '',
            'phone' => $this->phone ?? '',
            'secondary_phone' => $this->secondary_phone ?? '',
            'address' => $this->address ?? '',
            'footer_text' => $this->footer_text ?? '',
        ];



        Setting::where('key', 'general')->update(['value' => json_encode($settings)]);


        cache()->forget('settings');
        $this->dispatch('toast', ['type' => 'success', 'message' => 'Settings updated successfully!']);
    }
}
