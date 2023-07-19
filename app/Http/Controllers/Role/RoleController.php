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
    public function assignPermission()
    {
        $permissions = Permission::all();
        return view('Admin.Role.assign-permission',compact('permissions'));
    }
    public function syncPermissionToRole(Request $request)
    {
        $ids=  $request->input('permission',[]);
        $ids=  array_map('intval', $ids);
        $query = Permission::whereIn('id',$ids)->get();
        return $query;
    }
}
