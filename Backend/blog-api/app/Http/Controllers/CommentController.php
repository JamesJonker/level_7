<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{


    public function store(Request $request, $postId)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $post = Post::find($postId);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->post_id = $postId;
        $comment->user_id = auth()->user()->id;

        $comment->save();

        return response()->json(['message' => 'Comment added successfully', 'comment' => $comment], 201);
    }

    public function index($postId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $comments = $post->comments; // Get comments for the post

        return response()->json($comments);
    }
    public function destroy($commentId)
{

    $comment = Comment::findOrFail($commentId);
    // Find the comment within that post
    // $comment = $post->comments()->findOrFail($commentId);

    // Delete the comment
    $comment->delete();

    return response()->json(['message' => 'Comment deleted successfully']);
}

    
}