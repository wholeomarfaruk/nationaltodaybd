<?php

namespace App\Livewire;

use App\Helpers\Uploader;
use App\Models\Ad;
use App\Models\Media;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditAd extends Component
{
    public $adId;
    public $status=false;
    public $title;
    public $description;
    public $link;
    use WithFileUploads;
    public $image;
    public $expire_at;
    public $ad_rule;

    public $ad;
    public function mount($adId)
    {

        $this->adId = $adId;
        $ad = Ad::find($adId);
        $this->ad = $ad;
        if (!$ad) {
            abort(404);
        }
        $this->status = $ad->status;
        $this->title = $ad->title;
        $this->description = $ad->description;
        $this->link = $ad->link;
        $this->image = $ad->image;
        $this->expire_at = Carbon::parse($ad->expire_at)->format('Y-m-d\TH:i'); // Convert to Y-m-d H:i:s format$ad->expire_at;
        $this->ad_rule = $ad->ad_rule;

    }
    public function expire_at($value)
    {
        dd($value);
        // Use Carbon to parse the value and set the seconds to zero,
        // ensuring the value is only up to the minute.
        if ($value) {
            $this->expire_at = Carbon::parse($value)->setSeconds(0)->format('Y-m-d H:i:s');
        }
    }

    public function render()
    {
        return view('livewire.edit-ad');
    }
    public function updateAd()
    {

        $ad = Ad::find($this->adId);
        if (!$ad) {
            $this->dispatch('showErrorAlert', 'Ad not found.');
            return;
        }

        if (!empty($this->image) && is_object($this->image)) {
            $this->validate([
                'image' => 'image|max:2048|mimes:jpg,jpeg,png,webp,gif,svg', // 1MB Max, 1 minute max duration
            ]);
        }




        $ad->status = $this->status;
        $ad->title = $this->title;
        $ad->description = $this->description;
        $ad->link = $this->link;
        // $ad->image = $this->image;
        $ad->expire_at = Carbon::parse($this->expire_at)->setSeconds(0)->format('Y-m-d H:i:s');
        $ad->ad_rule = $this->ad_rule;

        $ad->save();
        if (!empty($this->image) && is_object($this->image)) {
            Uploader::updateOrUploadImage($this->image, $ad);
        }
        session()->flash('updated', 'Ad updated successfully.');
        $this->dispatch('showSuccessAlert', 'Ad updated successfully.');
    }
}
