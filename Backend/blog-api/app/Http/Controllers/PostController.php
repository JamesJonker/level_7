<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return $posts;

    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post = Post::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'body' => $request->body,
        ]);
        
        return response()->json($post, 201);
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'string|max:255',
            'body' => 'string',
        ]);

        $post->update($request->only(['title', 'body']));

        return response()->json($post);
    }

    public function destroy($id)
    {
        // $this->authorize('delete', $post);
        // $post = POST::findOrFail($postid);
        $post = Post::findOrFail($id);

        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);

        // return response()->json(null, 204);
    }

    // public function register()
    // {
    //     // $this->authorize('update', $post);
        
    //     return('James New');
    // }
}
