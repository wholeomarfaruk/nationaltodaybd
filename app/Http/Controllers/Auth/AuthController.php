<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout(){
        // Logic for logging out the user
         Auth::guard('web')->logout();
        return redirect()->to('/'); // Redirect to the home page or login page after logout
    }
}
