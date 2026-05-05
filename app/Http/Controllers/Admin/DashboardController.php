<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $totalPost=Post::count();
        $totalVisit=Post::sum('views');
        $latestPosts=Post::latest()->take(5)->get();
        return view('admin.dashboard',compact('totalVisit','totalPost','latestPosts'));
    }
}
