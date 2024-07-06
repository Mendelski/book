<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        return BookResource::collection(Book::all());
    }

    public function store(BookRequest $request)
    {
        return new BookResource(Book::create($request->validated()));
    }

    public function show(Book $book)
    {
        return new BookResource($book);
    }

    public function update(BookRequest $request, Book $book)
    {
        $book->update($request->validated());

        return new BookResource($book);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json();
    }

    public function xmlImport(Book $book)
    {
        // code to import xml
    }
}
