@extends('layouts.users.app')
@section('title','Home')
@section('content')

@include('layouts.users.include.header')
<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Post preview-->
            @forelse ($posts as $post )
            <div class="post-preview">
                <div class="row">
                    <div class="col">

                        <a href="{{ route('post.show',$post->slug) }}">
                            <div class="">
                                <h2 class="post-title"> {{ $post->title }}
                                </h2>
                            </div>
                            <h3 class="post-subtitle">{{ $post->sub_title }}</h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!">{{ $post->user->name }}</a>
                            on {{ $post->published_at }}
                        </p>
                    </div>
                    <div class="col-1">
                        @if ($post->user->id == @Auth::user()->id)
                        <a class="btn btn-info btn-sm text-white" href="{{ route('post.edit', $post->slug ) }}">Edit</a>
                        <button class="btn btn-danger btn-sm text-white">Delete</button>
                        @endif
                    </div>
                </div>
            </div>
            <hr class="my-4" />


            @empty
            <p class="text-center"> There is No Post</p>

            @endforelse

            <!-- Divider-->
            <!-- Post preview-->


        </div>
    </div>
</div>

@endsection