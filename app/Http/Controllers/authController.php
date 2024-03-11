<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class authController extends Controller
{
    public function authMethod(Request $request){
        $validated = $request->validate([
            'email' =>'required|string|email',
            'password' => 'required'
        ]);
       $user =  User::create($validated);
        Auth::login($user);
        //Auth::user();
        return inertia('Dashboard');
    }
    public function viewDashboard(){
        Auth::user();  
        return inertia('Dashboard');
    }
}
