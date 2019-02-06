<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostsController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts= Post::orderBy('created_at', 'dsc')->paginate(10);
       
        return view ('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

       
        $this->validate($request, [
            'title'=>'required',
            'body'=> 'required',
            'upload_image'=>'image|nullable|max:1999'
            ]);
          //Handel foel upload
        

          if ($request->hasFile('upload_image')) {

                //Get file name with extenssion
                $filenameWithExt = $request->file('upload_image')->getClientOriginalName();
                //get only file name
                $filename= pathinfo($filenameWithExt. PATHINFO_FILENAME);
                $extension = $request->file('upload_image')->getClientOriginalExtension();
                //Filname to Store
             
                $filenameToStore =$filename['filename'] . '_' . time(). $extension;
                $path = $request->file('upload_image')->storeAs('public/cover_images', $filenameToStore);

          } else {
              $fileToSTore= 'noimage.jpg';
          }
             $post = new Post;
            $post->title= $request->input('title');
            $post->body= $request->input('body');
            $post->user_id= auth()->user()->id;
            $post->cover_image = $filenameToStore;
            $post->save();

            return redirect('/posts')->with('success', "Post created!");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
    
        return view ('posts.show')->with(['post'=> $post, 'id' =>$post->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Check for correnct user
      

        $post= Post::find($id);

        if(Auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Oh, no you don\'t');
        }

        return view ('posts.edit')->with('post', $post);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'title'=>'required',
            'body'=> 'required',
            'upload_image'=>'image|nullable|max:1999'
            ]);
          //Handel foel upload
        

          if ($request->hasFile('upload_image')) {

                //Get file name with extenssion
                $filenameWithExt = $request->file('upload_image')->getClientOriginalName();
                //get only file name
                $filename= pathinfo($filenameWithExt. PATHINFO_FILENAME);
                $extension = $request->file('upload_image')->getClientOriginalExtension();
                //Filname to Store
             
                $filenameToStore =$filename['filename'] . '_' . time() . "." . $extension;
                $path = $request->file('upload_image')->storeAs('public/images', $filenameToStore);

          } else {
              $fileToSTore= 'noimage.jpg';
          }
            $post = Post::find ($id);

            if(Auth()->user()->id !== $post->user_id) {
                return redirect('/posts')->with('error', 'Oh, no you don\'t');
            }
            $post->title= $request->input('title');
            $post->body= $request->input('body');
            $post->cover_image = $filenameToStore;
            $post->update();

            return redirect('/posts')->with('success', "Post created!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        //
        $post= Post::find($id);

        if(Auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Oh, no you don\'t');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted!');
    }
}
