<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserBook;

class UserBookController extends Controller
{
    public function getAll(){
        $user_books = UserBook::all();
        return response()->json($user_books);
    }
}