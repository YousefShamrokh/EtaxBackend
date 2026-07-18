<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\registerUserRequest;
use App\Http\Requests\loginUserRequest;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function register(registerUserRequest $request){
        $validated = $request->validated();

        $validated['password'] = bcrypt($validated['password']); 

        $user = User::create($validated);

        $user->sendEmailVerificationNotification();
        return response()->json($user, 201);
    }

    public function login(loginUserRequest $request){
        $validated = $request->validated();

    $user = User::where('email', $validated['email'])->first();

    if(!$user || !Hash::check($validated['password'], $user->password)){
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    if(!$user->hasVerifiedEmail()){
        return response()->json(['message' => 'Verify your email first'], 403);
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
    
    public function verifyEmail(Request $request,int $id, string $hash){
        if (!URL::hasValidSignature($request)) {
        return response()->json([
            'message' => 'Invalid or expired verification link.'
        ], 403);
    }

    $user = User::findOrFail($id);

    if (! hash_equals(sha1($user->getEmailForVerification()), $hash)) {
        return response()->json([
            'message' => 'Invalid verification hash.'
        ], 403);
    }

    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    return response()->json([
        'message' => 'Email verified successfully.'
    ]);
    }

    public function resendMail(Request $request){
        $user = User::where('email', $request->email)->first();

        if (!$user) {
        return response()->json([
        'message' => 'User not found.'
        ], 404);
    }

        if ($user->hasVerifiedEmail()) {
        return response()->json([
        'message' => 'Email is already verified.'
        ]);
    }
        $user->sendEmailVerificationNotification();

        return response()->json([
        'message' => 'Verification email sent.'
        ]);

    }
}