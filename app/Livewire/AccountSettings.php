<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;

class AccountSettings extends Component
{
    #[Validate('required', message: 'Current Password is required')]
    #[Validate('min:8', message: 'Current Password must be at least 8 characters')]
    #[Validate('current_password', message: 'Current Password is incorrect')]
    public $current_password;
    #[Validate('required', message: 'Password is required')]
    #[Validate('min:8', message: 'Password must be at least 8 characters')]
    public $password;

    #[Validate('required', message: 'Confirm Password is required')]
    #[Validate('min:8', message: 'Confirm Password must be at least 8 characters')]
    #[Validate('same:password', message: 'Passwords do not match')]
    public $password_confirmation;

    public  $logout=false;

    public function render()
    {
        return view('livewire.account-settings');
    }
    public function updatePassword()
    {

        $this->validate();

        $user = auth()->user();
        $user->password = bcrypt($this->password);
        $user->save();
        $this->reset('current_password', 'password', 'password_confirmation');

        if($this->logout) {
            auth()->logout();
            return redirect()->route('login');
        }

        session()->flash('success', 'Password updated successfully.');
    }
}
