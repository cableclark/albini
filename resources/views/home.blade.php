@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                      
                
                    <div class="panel-body">   
                        <a href="/posts/create" class="btn btn-success"> Create new post</a>  
                        
                         <h3> Your blog posts</h3>   <table class="table table-striped">
                            <tr>
                                <th> Title</th>
                                <th></th>
                                <th></th>
                            </tr>   
                            @if (count($user->posts) > 0)
                            @foreach($user->posts  as $post)
                            <tr>
                                <td> 
                                    {{$post->title}}
                                
                                </td>
                                <td><a href="posts/{{$post->id}}/edit" class="btn btn-success" ">Edit</a></td>
                                <td>
                                    <form action="posts/{{$post->id}}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{ csrf_field() }}
                                        
                                        <button type="submit" class="btn btn-danger"> Delete</button>
                                     
                                    </form>
                                </td>
                                </tr>     
                            @endforeach 
                            @else   
                                You nave no posts.
                            

                            @endif


                         </table>
                    </div>    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
