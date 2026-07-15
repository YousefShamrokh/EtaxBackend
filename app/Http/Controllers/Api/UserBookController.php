<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserBook;
use App\Http\Resources\UserBookResource;
use Illuminate\Http\JsonResponse;

class UserBookController extends Controller
{
    public function index() : JsonResponse {
        $user_books = UserBook::with(['user','book'])->get(); // all retrieves all rows in model and can't be used with query conditions unlike all
        return response()->json(UserBookResource::collection($user_books));
    }
}