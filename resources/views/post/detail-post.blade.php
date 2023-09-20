@extends('layouts.users.app')
@section('title'," $post->title ")
@section('content')

<header class="masthead" style="background-image: url('{{ $post->getFirstMediaUrl('image', 'thumb') }}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1>{{ $post->title }}</h1>
                    <h2 class="subheading">{{ $post->sub_title }}</h2>
                    <span class="meta">
                        Posted by
                        <a href="#!">{{ $post->user->name }}</a>
                        on

                        {{ date('d M Y', strtotime($post->published_at))}} || {{
                        \Carbon\Carbon::parse($post->published_at)->diffForHumans()}}
                    </span>

                    <span class="meta">
                        Last Edited
                        on {{ @$post->updated_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>

<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                {!! $post->body !!}
            </div>
        </div>
    </div>
</article>
@endsection