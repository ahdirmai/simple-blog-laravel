@extends('layouts.users.app')
@section('title'," $post->title ")
@section('content')

<header class="masthead" style="background-image: url('{{ $post->getFirstMediaUrl('image') }}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1 id="post_title">{{ $post->title }}</h1>
                    <h2 class="subheading" id="post_subTitle">{{ $post->sub_title }}</h2>
                    <span class="meta">
                        Posted by
                        <a href="#!">{{ $post->user->name }}</a>
                        on {{ $post->published_at }}
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

                <form action="{{ route('post.update',$post->slug) }}" method="POST" class="mb-2"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                            name="image" onchange="previewImage()">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <img id="image-preview" class="mt-2 hero-image" src="#" alt="Preview Gambar" style="display: none">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ old('title',$post->title) }}" oninput="updateTitle(this.value)">
                        @error('title')
                        <span class=" invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sub_title" class="form-label">Sub Title</label>
                        <input type="text" class="form-control @error('sub_title') is-invalid @enderror" id="sub_title"
                            name="sub_title" value="{{ old('sub_title' ,$post->sub_title) }}"
                            oninput="updateSubTitle(this.value)">
                        @error('sub_title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="article" class="form-label">Article</label>
                        <textarea class="form-control @error('article') is-invalid @enderror" id="article"
                            name="article" rows="5">{{ old('article',$post->body) }}</textarea>
                        @error('article')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    {{-- published using toggle--}}
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_published"
                                name="is_published" {{ $post->is_published ?"Checked":"" }}>
                            <label class="form-check-label" for="is_published">Publish</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</article>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#article' ) )
        .catch( error => {
            console.error( error );
        } );
        $("form").submit( function(e) {
            var messageLength = CKEDITOR.instances['editor'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'Please enter a message' );
                e.preventDefault();
            }
            });
</script>

<script>
    function previewImage() {
        var input = document.getElementById('image');
        var preview = document.getElementById('image-preview');
    var masthead = document.querySelector('.masthead');
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                masthead.style.backgroundImage = 'url(' + e.target.result + ')';

            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }
</script>


<script>
    function updateTitle(val){
// console.log('masuk');
document.getElementById("post_title").innerHTML = val;
}
function updateSubTitle(val){
document.getElementById("post_subTitle").innerHTML = val;
}
</script>
@endpush
@endsection