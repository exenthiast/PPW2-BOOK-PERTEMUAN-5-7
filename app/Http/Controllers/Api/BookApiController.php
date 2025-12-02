<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;

class BookApiController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->paginate(5);
        return BookResource::collection($books);
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return new BookResource($book);
    }

    public function store(Request $request)
    {
        $book = Book::create($request->all());
        return new BookResource($book);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());
        return new BookResource($book);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(['message' => 'Buku berhasil dihapus']);
    }
}
