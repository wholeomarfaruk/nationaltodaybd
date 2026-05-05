<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
class PostCreateCategory extends Component
{
    public $createModal = false;
    public $name;
    public $parent_id;
    public function render()
    {
            $categories = Category::with('children')->whereNull('parent_id')->get();

        return view('livewire.post-create-category',[
            'categories'=>$categories
        ]);
    }
                public function createCategory()
    {

        $this->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);
        $category = new Category();
        $category->name = $this->name;
        $category->parent_id = $this->parent_id;
        $category->save();
        $this->createModal = false;
        $this->dispatch('categoryCreated');
        $this->reset(['name', 'parent_id']);

    }
    public function openCreateModal()
    {
      $this->reset(['name', 'parent_id']);
        $this->createModal = true;
    }
}
