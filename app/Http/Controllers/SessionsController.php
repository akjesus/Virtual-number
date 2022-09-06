<?php

namespace App\Http\Controllers;
use App\Models\Numbers;
use App\Models\User;
use App\Models\Countries;
use App\Models\Operators;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {   $users = User::all();
        $numbers = Numbers::all();
        $countries = Countries::all();
        $operators = Operators::all();
        return view('session.login-session', compact('countries','operators'));
    }

    public function store()
    {
        $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required' 
        ]);

        if(Auth::attempt($attributes))
        {   
            session()->regenerate();
            $users = User::count();
            $numbers = Numbers::count();
            $sum = Numbers::sum('amount');
        return view('dashboard', compact('users', 'numbers', 'sum'));
        }
        else{

            return back()->withErrors(['email'=>'Email or password invalid.']);
        }
    }
    
    public function destroy()
    {

        Auth::logout();
        $countries = Countries::all();
        $operators = Operators::all();
        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
