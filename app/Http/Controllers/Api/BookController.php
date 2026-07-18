<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\createBookRequest;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request) : JsonResponse{
        $perPage = (int) $request->query('per_page', 15);
        $perPage = min(max($perPage, 1), 100);
        $books = Book::paginate($perPage)->withQueryString(); //allows user control of number of items per page
        return response()->json(BookResource::collection($books));
    }

    public function show(int $id) : JsonResponse{
        $book = Book::findOrFail($id);
        return response()->json(new BookResource($book));
    }

    public function store(createBookRequest $request) : JsonResponse{
        $data = $request->validated();
        $data['added_by'] = auth()->id();
        $book = Book::create($data);
        return response()->json(new BookResource($book), 201);
    }

    public function update(createBookRequest $request,int $id) : JsonResponse{ //createBookRequest reusable with put requests
        $book = Book::findOrFail($id);
        $book->update($request->validated());
        return response()->json(new BookResource($book));
    }

    public function destroy(int $id) : JsonResponse{
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(['message' => 'Book deleted']);
    }

    public function hardDelete(int $id) : JsonResponse{
        $book = Book::withTrashed()->findOrFail($id);
        $book->forceDelete();
        return response()->json(['message' => 'Book permanently deleted']);
    }

    public function restore(int $id) : JsonResponse{
        $book = Book::withTrashed()->findOrFail($id);
        $book->restore();
        return response()->json(['message' => 'Book restored']);
    }

    public function getSoftDeleted() : JsonResponse{
        $book = Book::onlyTrashed()->get();
        return response()->json(new BookResource($book));
    }
}