@extends('layouts.app')

@section ('content')

    <h1>Create Post</h1>
<form action="/posts" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="text">Title:</label><input class="form-control"  type="text" name="title">
        </div>
        <div class="form-group">
             <label for="body">Post:</label>
            <textarea name="body" id="summernote" ></textarea>
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