<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasPermissions;

class Users extends Component
{
    public $users;
    public $roles;
    public $selectedRole;
    public $name;
    public $email;
    public $password;
    public $userId;
    public $editModal = false;
    public $createModal = false;
    public $viewModal = false;
    public $viewUser = [];
    public $search = '';

    public function render()
    {

       if(!auth()->user()->can('user.view')) {
            return abort(403, 'Unauthorized action.');
        }

        $roles = Role::all(); // Fetch all roles from the database
        $this->roles = $roles; // Assign roles to the component property
        $users = User::all(); // Fetch all users from the database
        $this->users = $users; // Assign users to the component property
        if ($this->search) {
            $this->users = User::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->get();
        }
        return view('livewire.users');
    }
    public function deleteUser($userId)
    {
             if(!auth()->user()->can('user.delete')) {
            return abort(403, 'Unauthorized action.');
        }
        $user = User::find($userId);
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
             if(!auth()->user()->can('user.create')) {
            return abort(403, 'Unauthorized action.');
        }

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
        if ($this->selectedRole) {
            $role = Role::find($this->selectedRole);
            if ($role) {
                $user->assignRole($role);
            }
        }
        // Close the modal after user creation

        // Logic to create a new user
        session()->flash('message', 'User created successfully.');
        // $this->dispatch('userCreated');
        $this->dispatch('userCreated', );
        $this->createModal = false; // Close the create modal

    }
    public function openEditModal($id)
    {
             if(!auth()->user()->can('user.edit')) {
            return abort(403, 'Unauthorized action.');
        }
        $user = User::findOrFail($id);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedRole = $user->roles->first()->name; // Get the first role name
        $this->editModal = true;
    }
    public function openCreateModal()
    {
        $this->reset(['name', 'email', 'password', 'selectedRole']); // Reset form fields
        $this->createModal = true; // Open the create modal
        // $this->dispatch('openModal', 'createUserModal'); // Dispatch an event to open the modal
    }
    public function updateUser()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $User = User::findOrFail($this->userId);
        $User->name = $this->name;
        $User->email = $this->email;
        if ($this->password) {
            $User->password = bcrypt($this->password);
        }
        if ($this->selectedRole) {
            $role = Role::find($this->selectedRole);
            if ($role) {
                $User->syncRoles($role); // Sync the role with the user
            }
        }
        $User->save(); // Save the user

        session()->flash('success', 'User updated!');
        $this->editModal = false;

        $this->users = User::all(); // refresh list
        // $this->reset(['name', 'email', 'selectedRole', 'userId']); // Reset form fields
        $this->dispatch('userUpdated', ); // Close the modal after user update
    }
    public function openViewModal($id)
    {
        $user = User::with('roles')->findOrFail($id);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedRole = $user->getRoleNames()->first(); // Get the first role name
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
        $this->reset(['userId', 'name', 'email', 'selectedRole']); // Reset form fields
    }

}
