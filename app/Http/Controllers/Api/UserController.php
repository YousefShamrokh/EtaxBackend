<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function index() : JsonResponse{
        $users = User::all();
        return response()->json($users);
    }

    public function show(int $id) : JsonResponse{
        $user = User::find($id);
        if($user){
            return response()->json($user);
        }else{
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function store(Request $request) : JsonResponse{
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request,int $id) : JsonResponse{
        $user = User::find($id);
        if($user){
            $user->update($request->all());
            return response()->json($user);
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