<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\suscribtion;
use Illuminate\Support\Facades\Auth;
class authController extends Controller
{
    public function authMethod(Request $request){
        $validated = $request->validate([
            'email' =>'required|string|email',
            'password' => 'required'
        ]);
        $registeredUser = User::where('email', $request->email)->first();
        if($registeredUser){
            Auth::login($registeredUser);
            if($registeredUser->suscribtion()){
                return inertia('Dashboard');
            }else{
             return inertia('dashboardUnsuscribed');
            }
        }else{
            $user =  User::create($validated);
            Auth::login($user);
            return inertia('dashboardUnsuscribed');
        }
      
    }
    public function viewDashboard(){
        Auth::user();  
        return inertia('dashboardUnsuscribed');
    }
}
