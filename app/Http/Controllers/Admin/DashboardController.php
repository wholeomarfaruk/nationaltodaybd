<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        Ad::deactivateExpired();

        $totalPost = Post::count();
        $totalVisit = Post::sum('views');
        $totalCategories = Category::count();
        $totalActiveAds = Ad::where('status', 1)->count();
        $latestPosts = Post::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalVisit', 'totalPost', 'totalCategories', 'totalActiveAds', 'latestPosts'));
    }
}
