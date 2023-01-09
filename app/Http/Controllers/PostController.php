<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::all();
        return view('posts.index')->with('posts', $posts);
    }

    public function show(Post $post)
    {
        return view('posts.show')->with([
            'post' => $post,
            'recent_posts' => Post::latest()->get()->except($post->id)->take(5)
            ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $name = $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('post-photos', $name);
        
        $post = Post::create([
            'title' => $request->title,
            'shorts_content' => $request->short_content,
            'content' => $request->content,
            'photo' => $path,


        ]);

        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        return view('posts.edit')->with('post', $post);
    }

    public function update(StorePostRequest $request, Post $post)
    {
        if ($request->hasFile('photo')) {
            if (isset($post->photo)) {
                Storage::delete($post->photo);
            }

            $name = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('post-photos', $name);

        }
        $post->update([
            'title' => $request->title,
            'shorts_content' => $request->short_content,
            'content' => $request->content,
            'photo' => $path ?? $post->photo,
        ]);
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    public function delete()
    {
        return view('posts.delete');
    }
}
