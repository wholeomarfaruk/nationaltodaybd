<?php

namespace App\Livewire;

use App\Models\Author as ModelsAuthor;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Author extends Component
{
    public $profile_image;
    public $title;
    public $bio;

    public $authors;
    public $roles;
    public $selectedRole;
    public $name;
    public $email;
    public $phone;
    public $userId;
    public $editModal = false;
    public $createModal = false;
    public $viewModal = false;
    public $viewUser = [];
    public $search = '';

    public function render()
    {
        if (!auth()->user()->can('user.view')) {
            return abort(403, 'Unauthorized action.');
        }

        if ($this->search) {
            $this->authors = ModelsAuthor::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->get();
        } else {
            $this->authors = ModelsAuthor::all();
        }

        return view('livewire.author', [
            'authors' => $this->authors, // pass to view
        ]);
    }

    public function deleteUser($userId)
    {
        if (!auth()->user()->can('user.delete')) {
            return abort(403, 'Unauthorized action.');
        }
        $user = ModelsAuthor::find($userId);
        if ($user) {
            $user->delete();
            session()->flash('message', 'User deleted successfully.');
            $this->dispatch('userDeleted', );
        } else {
            session()->flash('error', 'User not found.');
            $this->dispatch('userNotFound', );
        }
    }
    public function createUser()
    {
        if (!auth()->user()->can('user.create')) {
            return abort(403, 'Unauthorized action.');
        }

        $this->validate([
            'name' => 'required|string|max:255',
        ]);
        $author = new ModelsAuthor();
        if ($this->name) {
            $author->name = $this->name;
        }
        if ($this->title) {
            $author->title = $this->title;
        }
        if ($this->email) {
            $author->email = $this->email;
        }
        if ($this->phone) {
            $author->phone = $this->phone;
        }
        if ($this->bio) {
            $author->bio = $this->bio;
        }
        if ($this->profile_image) {
            $author->profile_image = $this->profile_image->store('profile_images', 'public');
        }
        if ($this->name) {
            $slug = Str::slug($this->name);
            while (ModelsAuthor::where('slug', $slug)->exists()) {
                $slug = Str::slug($this->name) . '-' . rand(1, 100);
            }
            $author->slug = $slug;
        }
        $author->save();

        // Close the modal after user creation

        // Logic to create a new user
        session()->flash('message', 'User created successfully.');
        // $this->dispatch('userCreated');
        $this->dispatch('userCreated', );
        $this->createModal = false; // Close the create modal

    }
    public function openEditModal($id)
    {
        if (!auth()->user()->can('user.edit')) {
            return abort(403, 'Unauthorized action.');
        }
        $user = ModelsAuthor::findOrFail($id);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->title = $user->title;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->bio = $user->bio;
        $this->profile_image = $user->profile_image;
        $this->editModal = true;
    }
    public function openCreateModal()
    {
        $this->reset(['name', 'title', 'email', 'phone', 'bio', 'profile_image']); // Reset form fields
        $this->createModal = true; // Open the create modal
        // $this->dispatch('openModal', 'createUserModal'); // Dispatch an event to open the modal
    }
    public function updateUser()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $author = ModelsAuthor::findOrFail($this->userId);
        $author->name = $this->name;
        $author->title = $this->title;
        $author->email = $this->email;
        if ($this->phone) {
            $author->phone = $this->phone;
        }
        if ($this->bio) {
            $author->bio = $this->bio;
        }
        if ($this->profile_image) {
            $author->profile_image = $this->profile_image;
        }
        if ($this->name && $author->slug != Str::slug($this->name)) {
            $slug = Str::slug($this->name);
            while (ModelsAuthor::where('slug', $slug)->exists()) {
                $slug = Str::slug($this->name) . '-' . rand(1, 100);
            }
            $author->slug = $slug;
        }

        $author->save(); // Save the user

        session()->flash('success', 'User updated!');
        $this->editModal = false;

        $this->authors = ModelsAuthor::all(); // refresh list
        // $this->reset(['name', 'email', 'selectedRole', 'userId']); // Reset form fields
        $this->dispatch('userUpdated', ); // Close the modal after user update
    }
    public function openViewModal($id)
    {
        $user = ModelsAuthor::findOrFail($id);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->title = $user->title;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->bio = $user->bio;
        $this->profile_image = $user->profile_image;
        $this->viewModal = true;
    }
    public function closeViewModal()
    {
        $this->viewModal = false; // Close the view modal
        $this->reset(['userId', 'name', 'email', 'selectedRole']); // Reset form fields

    }
    public function closeEditModal()
    {
        $this->editModal = false; // Close the edit modal
        $this->reset(['userId', 'name', 'email', 'phone', 'title', 'bio']); // Reset form fields
    }

}

