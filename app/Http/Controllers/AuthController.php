<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // register users
    public function register(Request $request){
        // validate the request

        $request->validate([
            'username' => ['required','unique:users,username','string','max:255'],
            'email' => ['required','email','unique:users,emsil','string','max:255'],
            'role' => ['required','string','in:job_seeker,employer,admin'],
            'password' => ['required','string','confirmed']
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);

        return response()->json(['message' => 'User registered successfully','user' => $user], 201);
    }

    
}
