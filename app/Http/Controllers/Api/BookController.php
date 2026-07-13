<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\createBookRequest;

class BookController extends Controller
{
    public function index() : JsonResponse{
        $books = Book::all();
        return response()->json($books);
    }

    public function show(int $id) : JsonResponse{
        $book = Book::find($id);
        if($book){
            return response()->json($book);
        }else{
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    public function store(createBookRequest $request) : JsonResponse{
        $data = $request->validated();
        $data['added_by'] = auth()->id('user_id');
        $book = Book::create($data);
        return response()->json($book, 201);
    }

    public function update(createBookRequest $request,int $id) : JsonResponse{ //createBookRequest reusable with put requests
        $book = Book::find($id);
        if($book){
            $book->update($request->validated());
            return response()->json($book);
        }else{
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    public function destroy(int $id) : JsonResponse{
        $book = Book::find($id);
        if($book){
            $book->delete();
            return response()->json(['message' => 'Book deleted']);
        }else{
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    public function hardDelete(int $id) : JsonResponse{
        $book = Book::withTrashed()->find($id);
        if($book){
            $book->forceDelete();
            return response()->json(['message' => 'Book permanently deleted']);
        }else{
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    public function restore(int $id) : JsonResponse{
        $book = Book::withTrashed()->find($id);
        if($book){
            $book->restore();
            return response()->json(['message' => 'Book restored']);
        }else{
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    public function getSoftDeleted() : JsonResponse{
        $book = Book::onlyTrashed()->get();
        return response()->json($book);
    }
}
