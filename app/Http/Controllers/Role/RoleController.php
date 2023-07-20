<?php

namespace App\Http\Controllers\Role;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        return view('Admin.Role.index',compact('roles'));
    }
    public function assignPermission($id)
    {
        $role = Role::find($id);
        $hasPermission = $role->permissions->pluck('name')->toArray();       
        $permissions = Permission::all();
        return view('Admin.Role.assign-permission',compact(['permissions','id','hasPermission']));
    }
    public function syncPermissionToRole(Request $request,$id)
    {
        $role = Role::find($id);
        $ids=  $request->input('permission',[]);
        $ids=  array_map('intval', $ids);
        $role->syncPermissions($ids);
        return redirect()->route('roles')->with('success','You Have Successfuly Assign New Permission to '. ucfirst($role->name).' Role');
    }
}
