<?php

namespace App\Livewire;

use App\Models\MainMenu as ModelsMainMenu;
use Illuminate\Support\Str;
use Livewire\Component;

class MainMenu extends Component
{
    public $allCategories;
    public $categories;
    public $selectedCategory;
    public $selectedCategory_parent_id;
    public $new_url;
    public $edit_url;
    public $edit_status;
    public $new_status;
    public $editModal = false;
    public $editCategoryId;
    public $editCategoryName;
    public $name;
    public $parent_id;
    public $createModal = false;
    public $order_number = 0;

    public $search = '';
    public function mount()
    {
        $this->allCategories = ModelsMainMenu::orderBy('sort', 'asc')->get();
        $this->categories = ModelsMainMenu::with('children.children')->whereIn('parent_id', [0, null])->orderBy('sort', 'asc')->get();
    }

    public function render()
    {
        if ($this->search) {

            $this->categories = ModelsMainMenu::with('children.children')
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhereHas('children', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        });
                })
                ->orderBy('sort', 'asc')
                ->get();
        } else {
            $this->categories = ModelsMainMenu::with('children.children')->whereIn('parent_id', [0, null])
                ->orderBy('sort', 'asc')
                ->get();
        }

        return view('livewire.main-menu');
    }
    public function createCategory()
    {

        $this->validate([
            'name' => 'required|string|max:255',
        ]);
        $category = new ModelsMainMenu();
        $category->name = $this->name;
        $category->parent_id = $this->parent_id !== null && $this->parent_id !== '' ? $this->parent_id : 0;

        if ($this->new_url) {
            $category->url = $this->new_url;
        }
        if ($this->new_status) {
            $category->status = $this->new_status;
        }
        if ($this->order_number !== '' && $this->order_number !== null) {
            $category->sort = $this->order_number;
        }

        $category->save();
        $this->createModal = false;
        $this->dispatch('categoryCreated');
        $this->reset(['name', 'parent_id', 'order_number', 'new_url', 'new_status']);

    }
    public function openCreateModal()
    {
        $this->reset(['name', 'parent_id', 'order_number', 'new_url', 'new_status']);
        $this->createModal = true;
    }
    public function delete($categoryId)
    {

        $category = ModelsMainMenu::find($categoryId);
        if ($category) {
            $category->delete();
            session()->flash('message', 'Category deleted successfully.');
            $this->dispatch('categoryDeleted');
        } else {
            session()->flash('error', 'Category not found.');
            $this->dispatch('categoryNotFound');
        }
    }
    public function openEditModal($categoryId)
    {
        $category = ModelsMainMenu::find($categoryId);

        if ($category) {
            $this->editCategoryId = $category->id;
            $this->editCategoryName = $category->name;
            $this->selectedCategory_parent_id = $category->parent_id;
            $this->edit_url = $category->url;
            $this->edit_status = $category->status;
            $this->order_number = $category->sort;
            $this->editModal = true;
        } else {
            session()->flash('error', 'Category not found.');
        }
    }
    public function updateCategory()
    {
        $this->validate([
            'editCategoryName' => 'required|string|max:255',
        ]);
        $category = ModelsMainMenu::find($this->editCategoryId);
        if ($category) {
            $category->name = $this->editCategoryName;

            if ($this->edit_url) {
                $category->url = $this->edit_url;
            }
            if ($this->edit_status) {
                $category->status = $this->edit_status;
            }
            if ($this->order_number !== '' && $this->order_number !== null) {
                $category->sort = $this->order_number;
            }
            $category->parent_id = $this->selectedCategory_parent_id !== null && $this->selectedCategory_parent_id !== '' ? $this->selectedCategory_parent_id : 0;
            $category->save();
            $this->editModal = false;
            $this->dispatch('categoryUpdated');
            $this->reset(['editCategoryId', 'editCategoryName', 'selectedCategory_parent_id','edit_url','order_number','edit_status']);
            $this->allCategories = ModelsMainMenu::all();
            session()->flash('message', 'Category updated successfully.');
        } else {
            session()->flash('error', 'Category not found.');
        }
    }
}
