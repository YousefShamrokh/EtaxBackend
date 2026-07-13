<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserBook;

class UserBookController extends Controller
{
    public function getAll(){
        $user_books = UserBook::all();
        return response()->json($user_books);
    }
}