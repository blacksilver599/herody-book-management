<?php

namespace App\Http\Controllers;

use App\Models\Book; // This is the line that was missing!
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return Book::with('author')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'author_id' => 'required|exists:authors,id',
            'published_at' => 'required|date',
        ]);

        return Book::create($validated);
    }

    public function show(Book $book)
    {
        return $book->load('author');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}