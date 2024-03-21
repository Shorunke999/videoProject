<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\suscribtion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class authController extends Controller
{
    public function authMethod(Request $request){
        $validated = $request->validate([
            'email' =>'required|string|email:unique',
            'password' => 'required|string'
        ]);
        $registeredUser = User::where('email', $request->email)->first();
        if($registeredUser){
            if(Hash::check($registeredUser->password,$request->password)){
                Auth::login($registeredUser);
                $aa = suscribtion::where('email', $request->email)->first();
                if( $aa!=null && $aa->subscription == true){
                    return inertia('Dashboard');
                }else{
                return inertia('dashboardUnsuscribed');
                }
            }else{
                return inertia('Registeration')->with('msg','invalid password');
            }
        }else{
                $user =  User::create([
                    'email'=> $request->email,
                    'password'=>Hash::make($request->password)
                ]);
                Auth::login($user);
                return inertia('dashboardUnsuscribed');
            }
      
      
    }
    public function viewDashboard(){
        return inertia('dashboardUnsuscribed');
    }
}
