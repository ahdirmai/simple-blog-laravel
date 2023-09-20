@extends('layouts.users.app')
@section('title','Create Post')
@section('content')

@include('layouts.users.include.header')
@push('styles')
<style>
    .hero-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }
</style>
@endpush

<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Cover Image</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post )

                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $post->title }}</td>
                        <td><img src="{{ $post->getFirstMediaURL('image')  }}" class="img-thumbnail"
                                alt="{{ $post->sub_title }}" style="max-height: 120px">
                        </td>
                        <td>{{ $post->is_published?"Published":"Draft" }}</td>
                        <td>
                            @if ($post->is_published)
                            <button class="btn btn-warning btn-sm"
                                data-url="{{ route('post.status-view',$post->slug) }}" data-bs-toggle="modal"
                                data-bs-target=".modal-basic" data-title="Unpublish Post">Un
                                Publish</button>
                            @else
                            <button class="btn btn-success btn-sm"
                                data-url="{{ route('post.status-view',$post->slug) }}" data-bs-toggle="modal"
                                data-bs-target=".modal-basic" data-title="Publish Post">Publish</button>

                            @endif
                            <a class="btn btn-info btn-sm" href="{{ route('post.edit', $post->slug ) }}">Edit</a>

                            <button class="btn btn-danger btn-sm" data-message="Are you sure delete this post?"
                                data-bs-toggle="modal" data-bs-target=".modal-delete" data-title="Delete Post"
                                data-url="{{ route('post.delete',$post->slug) }}">Delete</button>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@push('modal-section')
<x-basic-modal class="modal-md"></x-basic-modal>
<x-delete-modal class="modal-md"></x-delete-modal>
@endpush

@endsection