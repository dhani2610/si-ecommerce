<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store(Request $request)
    {
       
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->phone = $request->phone_number;
        $user->location = $request->address;
        $user->save();

        Auth::login($user); 
        if (Auth::user()->role == 'Admin') {
            return redirect('/dashboard');
        }else{
            return redirect('/');
        }
    }
}
