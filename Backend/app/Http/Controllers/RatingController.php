<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Http\Resources\RatingResource;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = Rating::with('user')->get();
        return RatingResource::collection($ratings);
    }

    public function store(RatingRequest $request)
    {
        $fields = $request->validated();
        $existingRating = Rating::where('user_id', $fields['user_id'])
                             ->where('book_id', $fields['book_id'])
                             ->first();

        if ($existingRating) {

            $existingRating->rating = $fields['rating'];
            $existingRating->save();


            $this->updateBookRating($fields['book_id']);

            return new RatingResource($existingRating);
        }


        $rating = Rating::create($fields);

        $this->updateBookRating($fields['book_id']);

        return new RatingResource($rating);
    }

    public function show(string $id)
    {
        $rating = Rating::find($id);
        if (!$rating) {
            return response()->json(['message' => 'Rating not found'], 404);
        }

        return new RatingResource($rating);
    }

    private function updateBookRating($bookId)
    {
        $book = Book::find($bookId);
        if ($book) {
            $avgRating = Rating::where('book_id', $bookId)->avg('rating') ?: 0;
            $book->rating = $avgRating;
            $book->save();
        }
    }
}
