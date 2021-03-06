@extends('layouts.app')

@section ('content')

    <h1>Edit Post</h1>
    <form action="/posts/{{$post->id}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            {{ csrf_field() }}
            <div class="form-group">
                <label for="text">Title:</label><input class="form-control"  type="text" name="title" value= "{{$post->title}}">
            </div>
            <div class="form-group">
                <label for="body">Post:</label>
            <textarea name="body" id="summernote">{{$post->body}}</textarea>
            </div>        
            <div class="form-group">
                    <label for="body"Upload file:</label>
                <input name="upload_image" type="file" >
            </div>     
            <div class="form-group">
                <button class="btn btn-success" type="submit">Submit</button>
            </div>
        </form>

        <script>
            $('#summernote').summernote({
            placeholder: 'Type your awesome Miss Albini text here...',
            tabsize: 2,
            height: 400
            });
        </script>

@endsection