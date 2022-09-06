<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App\Models\Numbers;

class HomeController extends Controller
{
    public function home()
    {
        
        return redirect('dashboard');
    }

    public function dashboard()
    {
        $users = User::count();
        $numbers = Numbers::count();
        $sum = Numbers::sum('amount');
        $allUsers= User::all();
        return view('dashboard', compact('allUsers', 'numbers', 'sum', 'users'));
    }
    
   
}



