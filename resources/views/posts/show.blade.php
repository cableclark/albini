@extends('layouts.app')

@section ('content')
<a href="/posts" class="btn btn-success"> Go Back </a>
    <div class="card">
        @if ($post)
        <h4> {{$post->title}}</h4>
        
        <p> {!! $post->body !!}</p>

        <small> {{$post->created_at->diffForHumans()}}</small>
    </div>
        @if(!Auth::guest())
           
            @if(Auth::user()->id == $post->user_id)       
            <div class="d-flex flex-row bd-highlight mb-3">
                <div class="p-2 bd-highlight">       
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-success"> Edit</a>
                </div> 
                <form action="{{$post->id}}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    {{ csrf_field() }}
                        <div class="p-2 bd-highlight">
                            <button type="submit" class="btn btn-danger"> Delete</button>
                        </div> 
                </form>
            @endif
            </div>
        @endif
    @else 
        <p> Post with id of {{$id}} does not exist</p>
     @endif   


@endsection