<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required' 
        ]);

        if(Auth::attempt($attributes))
        {
            session()->regenerate();
            if (Auth::user()->role == 'Admin') {
                return redirect('dashboard')->with('success','You are logged in.');
            }else{
                return redirect('/')->with('success','You are logged in.');
            }
        }
        else{
            return redirect()->back()->with('failed','Email or password invalid.');
        }
    }
    
    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
