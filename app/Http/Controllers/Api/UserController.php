<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\createUserRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{

    public function index() : JsonResponse{
        $users = User::all();
        return response()->json(UserResource::collection($users));
    }

    public function show(int $id) : JsonResponse{
        $user = User::find($id);
        if($user){
            return response()->json(new UserResource($user));
        }else{
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function store(createUserRequest $request) : JsonResponse{
        $user = User::create($request->validated());
        return response()->json(new UserResource($user),201);
    }

    public function update(createUserRequest $request,int $id) : JsonResponse{ //createUserRequest reusable with put requests
        $user = User::find($id);
        if($user){
            $user->update($request->validated());
            return response()->json(new UserResource($user),201);
        }else{
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function destroy(int $id) : JsonResponse {
        $user = User::find($id);
        if($user){
            $user->delete();
            return response()->json(['message' => 'User deleted']);
        }else{
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}