<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index()
    {
        return view('admin.ads.index');
    }
    public function edit($id)
    {
        $ad = Ad::findOrFail($id);

        return view('admin.ads.edit', compact('ad'));
    }
}
