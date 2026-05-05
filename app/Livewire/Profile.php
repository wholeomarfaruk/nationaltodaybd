<?php

namespace App\Livewire;

use Livewire\Component;

class Profile extends Component

{
    public bool $isProfileInfoModal = false;
    public bool $isProfileAddressModal = false;
    public  $profile;
    public $email;
    public $name;
    public $designation;
    public $phone;
    public $bio;
    public $instagram, $facebook, $twitter,$linkedin;
    public $address, $city, $country, $postal_code;

    public function mount()
    {
        $this->profile = auth()->user()->profile;
        if(!$this->profile || !$this->profile->exists) {
      return abort(404, 'Profile not found');
        }

        $this->email = $this->profile->email;
        $this->name = $this->profile->name;
        $this->designation = $this->profile->user->roles()->first()->name;
        $this->phone = $this->profile->phone;
        $this->phone = $this->profile->phone;
        $this->bio = $this->profile->bio;
        //social
        $this->instagram = $this->profile->instagram;
        $this->facebook = $this->profile->facebook;
        $this->twitter = $this->profile->twitter;
        $this->linkedin = $this->profile->linkedin;
    }
    public function render()
    {
        return view('livewire.profile');
    }
    public function updateProfile()
    {
        $this->profile->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'bio' => $this->bio,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'linkedin' => $this->linkedin
        ]);
        $this->profile->user->update([
            'name' => $this->name
        ]);
        $this->isProfileInfoModal = false;

    }
        public function updateAddress()
    {
        $this->profile->update([
            'address' => $this->address,
            'country' => $this->country,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
        ]);
        $this->isProfileAddressModal = false;

    }
}
