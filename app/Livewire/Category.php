<?php

namespace App\Livewire;
use App\Models\Category as CategoryList;
use Illuminate\Support\Str;
use Livewire\Component;

class Category extends Component
{
    public $allCategories;
    public $categories;
    public $selectedCategory;
    public $selectedCategory_parent_id;
    public $editModal = false;
    public $editCategoryId;
    public $editCategoryName;
    public $name;
    public $parent_id;
    public $createModal = false;
    public $search = '';
    public $category;
    public $edit_url='';
    public function mount()
    {
        $this->allCategories = CategoryList::all();
        $this->categories = CategoryList::with('children')->whereNull('parent_id')->get();
    }

    public function render()
    {
        if ($this->search) {

            $this->categories = CategoryList::where('name', 'like', '%' . $this->search . '%')
                ->orWhereHas('children', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })->get();
        } else {
            $this->categories = CategoryList::with('children')->whereNull('parent_id')->get();
        }

        return view('livewire.category');
    }
    public function createCategory()
    {

        $this->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);
        $category = new CategoryList();
        $category->name = $this->name;
        $category->parent_id = $this->parent_id;
        // Slug is generated & kept unique automatically by the Category model.
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
    public function delete($categoryId)
    {

        $category = CategoryList::find($categoryId);
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
        $category = CategoryList::find($categoryId);
        $this->category=$category;

        if ($category) {
            // Backfill a slug for any legacy row that is missing one so the
            // route below never fails with a missing parameter.
            if (empty($category->slug)) {
                $category->save(); // model saving-hook generates the slug
            }
            $this->editCategoryId = $category->id;
            $this->editCategoryName = $category->name;
            $this->selectedCategory_parent_id = $category->parent_id;
            $this->edit_url = route('category', ['category' => $category->slug]);
            $this->editModal = true;
        } else {
            session()->flash('error', 'Category not found.');
        }
    }
    public function updateCategory()
    {
        $this->validate([
            'editCategoryName' => 'required|string|max:255',
            'selectedCategory_parent_id' => 'nullable|exists:categories,id',
        ]);
        $category = CategoryList::find($this->editCategoryId);
        if ($category) {
            $category->name = $this->editCategoryName;
            // Regenerate the slug from the (edited) name; the Category model
            // keeps it unique and non-empty on save.
            $category->slug = Str::slug($this->editCategoryName);
            $category->parent_id = $this->selectedCategory_parent_id;
            $category->save();
            $this->editModal = false;
            $this->dispatch('categoryUpdated');
            $this->reset(['editCategoryId', 'editCategoryName', 'selectedCategory_parent_id']);
            $this->allCategories = CategoryList::all();
            session()->flash('message', 'Category updated successfully.');
        } else {
            session()->flash('error', 'Category not found.');
        }
    }
}
