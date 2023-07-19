<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignInController extends Controller
{
    // public function login(Request $req)
    // {
    //     // $req->merge(['password'=>Hash::make($req->password)]);
    //     $credentials = $req->only('','password');
    //     // if ($credentials['email'] === 'admin@admin.com' && Hash::check('12345678', $credentials['password'])) 
    //     // { 
    //     //     $credentials['password'] = '12345678';
    //         if (Auth::attempt($credentials)) {
    //             return redirect()->route('investor.index');          
    //         }         
    //     // }
    //     return back()->withErrors([
    //         'error' => 'Invalid email or password',
    //     ]);

    // }

    public function login(Request $req)
    {
        // return $req->all();
        $credentials = $req->validate([
            'email' => 'required',
            'password' => 'required',
            'role' => 'required|in:admin,user,support',
        ]);
        $credentials = $req->only('email','password');
        $role = $req->role;
        if (Auth::attempt($credentials)) {
            
            return redirect()->route($role . '.dashboard');
        } else {
            return back()->withErrors([
                'credentials' => 'Invalid credentials.',
            ]);
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login-form');
    }
}
