<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('categories')->get();
        return new BookCollection($books);
    }

    public function store(BookRequest $request)
    {
        $fields = $request->validated();
        $book = Book::create($fields);
        $book->categories()->attach($request->category_id);

        return response()->json([new BookResource(Book::with('categories')->find($book->id))], 201);
    }

    public function show(string $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return new BookResource($book);
    }

    public function update(BookRequest $request, string $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->update($request->validated());
        return new BookResource($book);
    }

    public function destroy(string $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();
        return response(null, 204);
    }

    public function incrementViews(string $id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->increment('views');
            return new BookResource($book);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    public function MostviewedBooks()
    {
        $books = Book::orderBy('views', 'desc')
            ->take(5)
            ->get();

        return new BookCollection($books);
    }

    public function oldestBooks()
    {
        $books = Book::orderBy('publish_date', 'asc')
            ->take(5)
            ->get();

        return new BookCollection($books);
    }

    public function newestBooks()
    {
        $books = Book::orderBy('publish_date', 'desc')
            ->take(5)
            ->get();

        return new BookCollection($books);
    }

    public function MostLikedBooks()
    {
        $books = Book::orderBy('rating', 'desc')
            ->take(5)
            ->get();

        return new BookCollection($books);
    }

    public function MostCommentedBooks()
    {
        $books = Book::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(5)
            ->get();

        return new BookCollection($books);
    }

    public function searchBooks(string $search)
    {
        $books = Book::where('title', 'like', '%' . $search . '%')
            ->orWhere('author', 'like', '%' . $search . '%')
            ->get();

        return new BookCollection($books);
    }

    public function getBooksByAuthor(string $author)
    {
        $books = Book::where('author', 'like', '%' . $author . '%')
            ->get();

        return new BookCollection($books);
    }
}
