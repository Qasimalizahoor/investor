<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Status;
use App\Models\Investor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\UserCreatedMail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\InvestorStoreRequest;

class InvestorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
        // return $status;
        return view('Admin.Investor.index',compact('statuses'));
    }
    public function getInvestor(Request $request)
    {
       $query = Investor::with(['user','status'])->get();
             
        return Datatables::of($query)
            ->addColumn('action', function ($query) { {
                        return '<a href="javascript:void(0)" data-id="'.$query->id.'" class="edit btn btn-primary btn-sm me-1 edit-investor">Edit</a><a href="javascript:void(0)" data-id="' . $query->id . '" class="delete-investor btn btn-danger btn-sm">Delete </a>';
                }
            })
            ->rawColumns(['action'])
            // ->addIndexColumn()
            ->make(true);
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
    public function store(InvestorStoreRequest $request)
    {
        try
        {
        $investorTable = $request->only(['phone','address']);
        $userTable = $request->only(['name','email']);
        $investor = new Investor();
        $user = new User();
        $investor->fill($investorTable);
        $user->fill($userTable);

        // Generate Random Word.
        $plainPassword = strtoupper(Str::random(8));
        $password = bcrypt($plainPassword);     

        $user->password = $password;
        $investor->status_id = 1;
        
        DB::beginTransaction();

        $user->save();
        $user->investor()->save($investor);

        // Assign Role
        $role = Role::where('name','user')->pluck('name');
        $user->assignRole($role);

        DB::commit();

        $details = $request->only(['name','email']);
        $details['password'] = $plainPassword;
        Mail::to($details['email'])->send(new UserCreatedMail($details));
        return response()->json(['success'=>'New Investor Record Added Successfully']);
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function show(Investor $investor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query = Investor::with(['user','status'])->findOrFail($id);
        return response()->json($query);
        // return $query;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // This id is an investor table.
        $query = Investor::findOrFail($id);
        // $user = User::findOrFail($userId);
        // dd($request->all());
    
        // Update the associated Investor record
        $query->phone = $request->input('phone');
        $query->address = $request->input('address');
        $query->user->email = $request->input('email');
        $query->user->name = $request->input('name');
        $query->save();
        $query->user->save();
        return response()->Json(['success','Your Record is sucessfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $investor = $request['user_id'];

        // $query = Investor::find($investor)->user->delete();
        $query = Investor::find($investor);
        $query->user()->delete();
        $query->delete();

        return $query;
    }
}
