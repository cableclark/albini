@if (count($errors)> 0)
    @foreach($errors->all() as $error)
    <div class="alter alert-danger">
        {{$error}} 
    </div>
    @endforeach
@endif

@if (session('success')> 0)
    <div class="alter alter-success">
        {{session('success')}}
    </div>     
@endif

@if (session('error')> 0)
    <div class="alter alter-danger">
        {{session('error')}}
    </div>     
@endif


