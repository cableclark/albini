@extends('layouts.app')

@section ('content')

<h3> Posts</h3>
@if (count($posts)> 0)
    @foreach ($posts as $post)
    <div class="card">
        <div class="row">
            <div class="col-md-4 col-sm-4"> 
                <img src="{{asset('storage/images/'. $post->cover_image)}}">
            </div>
            <div class="col-md-4 col-sm-4"> 
                 <a href= "posts/{{$post->id}}"> <h4> {{$post->title}}</h4></a>
    
                <p> {!!$post->body!!}</p>
        
                <small> {{$post->created_at->diffForHumans()}}</small>
                  <img src ="{{asset('storage/images/2002_46_9_1549281232.jpg')}}">     
            </div>
        </div>
           
    </div>
    {{$posts->links()}}

    @endforeach
  @else
      <p> No posts found</p>
    @endif
@endsection