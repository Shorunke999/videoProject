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
        User::create($validated);
        Auth::login();
        return inertia('Dashboard');
    }
}
