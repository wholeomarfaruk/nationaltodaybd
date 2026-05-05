<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function editRole($id)
    {
        if(!auth()->user()->can('role.edit')) {
            return abort(403, 'You don’t have permission to access this page.');
        }
        $role = Role::with('permissions')->where('id', $id)->first();
        $permissions = Permission::all();
        if (!$role) {
            session()->flash('error', 'Role not found.');
            Alert::error('Error', 'Role not found.');
            return redirect()->back();
        }
        return view('admin.role-edit', compact('role', 'permissions'));
    }
    public function updateRole(Request $request, $id)
    {
        if(!auth()->user()->can('role.edit')) {
            return abort(403, 'You don’t have permission to access this page.');
        }
        // return $request->all(); // Debugging line to check the request data
        $request->validate([
            'name' => "required|unique:roles,name,{$id}",
        ]);
        $role = Role::find($id);

        if (!$role) {
            session()->flash('error', 'Role not found.');

            return redirect()->back();
        }

        $role->name = $request->input('name');
        $role->save();
        // Sync permissions if provided
        if ($request->has('permissions')) {
            $role->syncPermissions($request->input('permissions'));
        }else {
            $role->syncPermissions([]); // Clear permissions if none are selected
        }

        session()->flash('success', 'Role updated successfully.');

        return redirect()->route('admin.roles');
    }

    public function createRoleForm()
    {
        if(!auth()->user()->can('role.create')) {
            return abort(403, 'You don’t have permission to access this page.');
        }
        $permissions = Permission::all();
        return view('admin.role-create', compact('permissions'));
    }
    public function createRole(Request $request)
    {
        if(!auth()->user()->can('role.create')) {
            return abort(403, 'You don’t have permission to access this page.');
        }
        // return $request->all(); // Debugging line to check the request data
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create(['name' => $request->input('name')]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->input('permissions'));
        }

        session()->flash('success', 'Role created successfully.');

        return redirect()->route('admin.roles');
    }
}
