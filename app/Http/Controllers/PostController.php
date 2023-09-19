<?php

namespace App\Http\Controllers;

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
    public function store(Request $request, FlasherInterface $flasher)
    {


        // return $request;
        $status = 0;
        if ($request->file('is_published')) {
            $status = 1;
        }


        $post = Post::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'slug' => \Str::slug($request->title),
            'body' => $request->article,
            'is_published' => $status,
            'published_at' => Carbon::now(),
            'user_id' => auth()->user()->id
        ]);
        $upImage =  $post->addMediaFromRequest('image')->toMediaCollection('image');

        $flasher->addSuccess('POST CREATED SUCCESSFULLY');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, $slug)
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
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
