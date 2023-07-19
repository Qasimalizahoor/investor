<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        $statuses = Status::all();
        $role = 'admin';
        return view('Admin.Investor.index',compact('statuses'));

    }
    public function user()
    {
        $statuses = Status::all();
        $role = 'user';
        return view('Admin.Investor.index',compact('statuses'));
    }
    public function support()
    {
        $statuses = Status::all();
        $role = 'support';
        return view('Admin.Investor.index',compact('statuses'));
    }
}
