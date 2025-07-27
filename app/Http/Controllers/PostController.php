<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // সব পোস্ট দেখানো
    public function index()
    {
        return Post::all();
    }

    // নতুন পোস্ট তৈরি করা
    public function store(Request $request)
    {
        $post = Post::create($request->only(['title', 'content']));
        return response()->json($post, 201);
    }

    // নির্দিষ্ট পোস্ট দেখানো
    public function show($id)
    {
        return Post::findOrFail($id);
    }

    // পোস্ট আপডেট করা
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->only(['title', 'content']));
        return response()->json($post);
    }

    // পোস্ট ডিলিট করা
    public function destroy($id)
    {
        Post::destroy($id);
        return response()->json(null, 204);
    }
}
