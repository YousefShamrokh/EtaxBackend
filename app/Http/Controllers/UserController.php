<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function getAll(){
        $users = User::all();
        return response()->json($users);
    }

    public function find($id){
        $user = User::find($id);
        if($user){
            return response()->json($user);
        }else{
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function create(Request $request){
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        if($user){
            $user->update($request->all());
            return response()->json($user);
        }else{
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function delete($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            return response()->json(['message' => 'User deleted']);
        }else{
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}