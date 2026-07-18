<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\createUserRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{

    public function index() : JsonResponse{
        $users = User::paginate()->withQueryString(); // no parameters defaults to 15 items per page
        return response()->json(UserResource::collection($users));
    }

    public function show(int $id) : JsonResponse{
        $user = User::findOrFail($id);
            return response()->json(new UserResource($user));
    }

    public function store(createUserRequest $request) : JsonResponse{
        $user = User::create($request->validated());
        return response()->json(new UserResource($user),201);
    }

    public function update(createUserRequest $request,int $id) : JsonResponse{ //createUserRequest reusable with put requests
        $user = User::findOrFail($id);
            $user->update($request->validated());
            return response()->json(new UserResource($user),201);
    }

    public function destroy(int $id) : JsonResponse {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
}