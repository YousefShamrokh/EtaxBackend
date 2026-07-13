<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $validated = $request->validate([
            'User_Name' => 'required | string | max: 50',
            'User_Email' => 'required | string | email | max: 50 | unique:users',
            'password' => 'required | string | min: 8'
        ]);

        $validated['password'] = bcrypt($validated['password']); 

        $user = User::create($validated);
        return response()->json($user, 201);
    }

    public function login(Request $request){
        $validated = $request->validate([
            'User_Email' => 'required | string | email',
            'password' => 'required | string'
        ]);

    $user = User::where('User_Email', $validated['User_Email'])->first();

    if(!$user || !Hash::check($validated['password'], $user->password)){
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken("LibraryToken")->plainTextToken;

    return response()->json([
        'token'=>$token,
        'user'=>$user
    ]);
    }

    public function logout(Request $request)
    {
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        "message"=>"Logged out"
    ]);
    }   
}
