<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class CommentController extends Controller
{
    public function index()
    {
        return new CommentCollection(Comment::with('user')->get());
    }

    public function create(CommentRequest $request)
    {
        $fields = $request->validated();
        $comment = Comment::create($fields);

        return new CommentResource(Comment::with('user')->find($comment->id));
    }

    public function store(CommentRequest $request)
    {
        $fields = $request->validated();
        $comment = Comment::create($fields);

        return new CommentResource(Comment::with('user')->find($comment->id));
    }

    public function show(string $id)
    {
        $comment = Comment::with('user')->find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        return new CommentResource($comment);
    }

    public function update(CommentRequest $request, string $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $comment->update($request->validated());

        return new CommentResource(Comment::with('user')->find($comment->id));
    }

    public function destroy(string $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $comment->delete();
        return response()->json(null, 204);
    }
}
