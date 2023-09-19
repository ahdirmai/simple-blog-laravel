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
        <div class="col-md-10 col-lg-8 col-xl-7">
            <form action="{{ route('post.store') }}" method="POST" class="mb-2" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image" required onchange="previewImage()">
                </div>
                <img id="image-preview" class="mt-2 hero-image" src="#" alt="Preview Gambar" style="display: none">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="sub_title" class="form-label">Sub Title</label>
                    <input type="text" class="form-control" id="sub_title" name="sub_title" required>
                </div>
                <div class="mb-3">
                    <label for="article" class="form-label">Article</label>
                    <textarea class="form-control" id="article" name="article" rows="5"></textarea>
                </div>
                {{-- published using toggle--}}
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_published"
                            name="is_published">
                        <label class="form-check-label" for="is_published">Publish</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>

<script>
    function previewImage() {
        var input = document.getElementById('image');
        var preview = document.getElementById('image-preview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }
</script>

<script>
    ClassicEditor
        .create( document.querySelector( '#article' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

@endpush

@endsection