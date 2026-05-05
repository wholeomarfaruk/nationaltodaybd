<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function allMenuList(){
        if(!auth()->user()->can('category.view')) {
            return abort(403, 'You don’t have permission to access this page.');
        }
        return view('admin.menu-list');
    }
    public function menuList()
    {
          if(!auth()->user()->can('category.view')) {
            return abort(403, 'You don’t have permission to access this page.');
        }
        return view('admin.menu');
    }
    public function mainMenuList()
    {
          if(!auth()->user()->can('category.view')) {
            return abort(403, 'You don’t have permission to access this page.');
        }
        return view('admin.main-menu');
    }


}
