<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\registerUserRequest;
use App\Http\Requests\loginUserRequest;

class AuthController extends Controller
{
    public function register(registerUserRequest $request){
        $validated = $request->validated();

        $validated['password'] = bcrypt($validated['password']); 

        $user = User::create($validated);
        return response()->json($user, 201);
    }

    public function login(loginUserRequest $request){
        $validated = $request->validated();

    $user = User::where('email', $validated['email'])->first();

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
