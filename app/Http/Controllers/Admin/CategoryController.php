<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryList()
    {
          if(!auth()->user()->can('category.view')) {
            return abort(403, 'You don’t have permission to access this page.');
        }
        return view('admin.category');
    }

}
