<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create',["ex" => "",
        "poop"=> Post::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'number' => 'required|integer',
            
        ]);

        Post::create($validated);

        return redirect()->route('posts.create')
            ->with('success', 'Post created successfully!');
    }
    public function index()
    {
        return Post::all();
    }
    public function show(int $id)
{
    $post = Post::find($id);
    return view('posts.show',['post'=> $post]);
}
public function edit(Post $post)
{
    return view('posts.edit', compact('post'));
}

public function update(Request $request, Post $post)
{
    $validated = $request->validate([
        'name'   => 'required|string|max:255',
        'number' => 'required|integer',
    ]);

    $post->update($validated);

    return redirect()->route('posts.show', $post)
        ->with('success', 'Post updated successfully!');
}
public function destroy(Post $post)
{
    $post->delete();

    return redirect()->route('posts.create')
        ->with('success', 'Post deleted.');
}
}