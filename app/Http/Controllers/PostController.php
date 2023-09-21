<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Carbon\Carbon;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->get();
        $data = [
            'posts' => $posts
        ];

        return view('post.index-post', $data);
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
    public function destroy($slug, FlasherInterface $flasher)
    {

        // return $slug;

        $post = Post::where('slug', $slug)->first();

        if ($post) {
            $delete_post = $post->delete();
            if ($delete_post) {

                $flasher->addSuccess('POST DELETED SUCCESSFULLY');
                return redirect()->back();
            }
        }
    }

    public function viewStatus($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if ($post->is_published) {
            $text = "UNPUBLISH";
        } else {
            $text = "PUBLISH";
        }
        $data = [
            "url" => route('post.status-change', $slug),
            "text" => $text
        ];

        return view('post.status-post', $data);
    }

    public function changeStatus($slug, FlasherInterface $flasher)
    {
        $post = Post::where('slug', $slug)->first();
        if (!$post->is_published) {

            // return 'masuk';
            $published_at = Carbon::now();
        } else {
            $published_at = null;
        }

        $post->update([
            'is_published' => !$post->is_published,
            'published_at' => $published_at
        ]);

        $flasher->addSuccess('POST PUBLISHED SUCCESSFULLY');
        return redirect()->back();
    }
}
