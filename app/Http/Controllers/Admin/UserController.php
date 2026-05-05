<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(){
        $user = auth()->user();
        $profile = auth()->user()->profile();
        if(!$profile || !$profile== null) {
            $profile = auth()->user()->profile()->create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'designation' => $user->roles()->first()->name,

            ]);
        }
        return view('admin.user.profile', compact('profile'));
    }
    public function accountSettings(){
        return view('admin.user.account-settings');
    }
}
