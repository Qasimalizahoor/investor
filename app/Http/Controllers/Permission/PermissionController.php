<?php

namespace App\Http\Controllers\Permission;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Contracts\DataTable;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('Admin.Permission.index');
    }

    public function getPermission()
    {
        $query = Permission::all();

        return DataTables::of($query)
        ->addColumn('action',function($query){{
            if(Auth::user()->can('add-permission') && Auth::user()->can('delete-permission'))
            {
                return '<a href="javascript:void(0)" data-id="'.$query->id.'" class="edit btn btn-primary btn-sm me-1 edit-permission"> Edit </a> 
                <a href="javascript:void(0)" data-id="' . $query->id . '" class="delete-permission btn btn-danger btn-sm">Delete </a>';
            }
            else if(Auth::user()->can('add-permission') )
            {
                return '<a href="javascript:void(0)" data-id="'.$query->id.'" class="edit btn btn-primary btn-sm me-1 edit-permission"> Edit </a>';
            }
            else if( Auth::user()->can('delete-permission'))
            {
                return '<a href="javascript:void(0)" data-id="' . $query->id . '" class="delete-permission btn btn-danger btn-sm">Delete </a>';
            }
            else
            {
                return "<a href='javascript:void(0)'  class=' btn btn-danger btn-sm me-1 '>You Don't Have Permission</a>";
            }
            
        }})
        ->rawColumns(['action'])->make(true);
        // <a href="javascript:void(0)" data-id="' . $query->id . '" class="delete-investor btn btn-danger btn-sm">Delete </a>
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $name = $request->name;
         $store = Permission::create([
            'name' => $name,
         ]);
         return response()->json(['success'=>'New Permission Record Added']);
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        return $permission;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $query = Permission::find($id);
        if($query)
        {
            $query->name = $request->name;
            $query->save();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
