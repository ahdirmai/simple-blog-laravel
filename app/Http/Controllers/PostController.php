<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Carbon\Carbon;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('post.index-post');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create-post');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, FlasherInterface $flasher)
    {

        $status = 0;
        $published_at = "";
        if ($request->is_published) {
            $status = 1;
            $published_at = Carbon::now();
        } else {
            $published_at = null;
        }

        $post = Post::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'slug' => \Str::slug($request->title),
            'body' => $request->article,
            'is_published' => $status,
            'published_at' => $published_at,
            'user_id' => auth()->user()->id
        ]);

        $upImage =  $post->addMediaFromRequest('image')->toMediaCollection('image');

        $flasher->addSuccess('POST CREATED SUCCESSFULLY');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $data = [
            'post' => $post
        ];
        return view('post.detail-post', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $data = [
            'post' => $post
        ];
        return view('post.edit-post', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug, FlasherInterface $flasher)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $status = 0;
        $published_at = "";
        if ($request->is_published) {
            $status = 1;
            $published_at = Carbon::now();
        } else {
            $published_at = null;
        }

        $post->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'slug' => \Str::slug($request->title),
            'body' => $request->article,
            'is_published' => $status,
            'published_at' => $published_at,
            'user_id' => auth()->user()->id
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $post->clearMediaCollection('images');
            $post->addMediaFromRequest('image')->toMediaCollection('image');
        }

        $flasher->addSuccess('Post Edited SUCCESSFULLY');
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
