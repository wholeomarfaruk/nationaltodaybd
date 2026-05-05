<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    public $table = 'menus';
    protected $fillable = ['name', 'url', 'icon', 'parent_id', 'sort', 'status'];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('sort', 'asc');
    }
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

}
