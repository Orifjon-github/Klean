<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Http\Requests\StorePostRequest;
use App\Jobs\UploadBigFile;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
//        $this->middleware('password-confirm')->only('delete');
        $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {

        $posts = Post::latest()->paginate(3);
        return view('posts.index')->with('posts', $posts);
    }

    public function show(Post $post)
    {
        return view('posts.show')->with([
            'post' => $post,
            'recent_posts' => Post::latest()->get()->except($post->id)->take(5),
            'category' => Category::all(),
            ]);
    }

    public function create()
    {
        return view('posts.create')->with([
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    public function store(StorePostRequest $request)
    {
        $name = $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('post-photos', $name);

        $post = Post::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'shorts_content' => $request->short_content,
            'content' => $request->content,
            'photo' => $path,


        ]);

        if (isset($request->tags)) {
            foreach ($request->tags as $tag) {
                $post->tags()->attach($tag);
            }
        }

        PostCreated::dispatch($post);

        UploadBigFile::dispatch($post)->onQueue('uploading');

        Mail::to($request->user())->send((new \App\Mail\PostCreated($post))->onQueue('sending-mails'));



        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        // if (! Gate::allows('update-post', $post)) {
        //     abort(403);
        // }

        // Gate::authorize('update-post', $post);

        // $this->authorize('update', $post);

        return view('posts.edit')->with('post', $post);
    }

    public function update(StorePostRequest $request, Post $post)
    {
        // Gate::authorize('update-post', $post);
        // $this->authorize('update', $post);


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

    public function destroy(Post $post)
    {

        if (isset($post->photo)) {
            Storage::delete($post->photo);
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}
