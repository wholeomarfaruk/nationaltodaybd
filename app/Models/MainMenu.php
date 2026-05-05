<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainMenu extends Model
{
     protected $fillable = ['name', 'url', 'icon', 'parent_id', 'sort', 'status'];

    public function children()
    {
        return $this->hasMany(MainMenu::class, 'parent_id')->orderBy('sort', 'asc');
    }
    public function parent()
    {
        return $this->belongsTo(MainMenu::class, 'parent_id');
    }

}
