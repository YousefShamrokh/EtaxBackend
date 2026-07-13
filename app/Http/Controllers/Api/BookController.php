<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(){
        $books = Book::all();
        return response()->json($books);
    }

    public function show(int $id){
        $book = Book::find($id);
        if($book){
            return response()->json($book);
        }else{
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    public function create(Request $request){
        $book = Book::create($request->all());
        return response()->json($book, 201);
    }

    public function update(Request $request,int $id){
        $book = Book::find($id);
        if($book){
            $book->update($request->all());
            return response()->json($book);
        }else{
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    public function destroy(int $id){
        $book = Book::find($id);
        if($book){
            $book->delete();
            return response()->json(['message' => 'Book deleted']);
        }else{
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    public function hardDelete(int $id){
        $book = Book::withTrashed()->find($id);
        if($book){
            $book->forceDelete();
            return response()->json(['message' => 'Book permanently deleted']);
        }else{
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    public function restore(int $id){
        $book = Book::withTrashed()->find($id);
        if($book){
            $book->restore();
            return response()->json(['message' => 'Book restored']);
        }else{
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    public function getSoftDeleted(){
        $book = Book::onlyTrashed()->get();
        return response()->json($book);
    }
}
