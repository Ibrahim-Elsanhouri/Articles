<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Post;
use  App\User;
use  App\Tag;
use  App\Notifications\PostNewNotification; 
use Notification; 
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        //every request need to be authenticated 
        //$this->middleware('auth');
        // Only 
          //$this->middleware('auth' , ['only'=>['show']]);
          // Except
                  
          $this->middleware('auth' , ['except'=>['show' , 'index']]);

    }
    public function index()
    {
        //
        $posts = Post::orderBy('created_at', 'DESC')->paginate(5);
        return view('posts.index' , compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $tags = Tag::all();
        return view ('posts.create' , compact('tags'));
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
            'title' => 'required|min:3',
            'body' => 'bail|required|min:3',
         ]);
         $img_name = time().'.'.$request->url->getClientOriginalName();
     //$getimageName = time().'.'.$request->uplode_image_file->getClientOriginalExtension();

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = Auth::user()->id;
$post->url = $img_name; 
    
        $post->save();
        $post->tags()->sync($request->tags);
        $usernot = User::all();
        
        Notification::send($usernot , new PostNewNotification($post)) ;
        

     $request->url->move(public_path('upload') , $img_name );
       //   $request->url->move(public_path() , $img_name );

      // $request->uplode_image_file->move(public_path('upload'),  $img_name);

        return redirect('/posts')->with('success','Post created successfully'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        return view('posts.show' , compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if($post->user_id !==Auth::user()->id ){
            return redirect('posts')->with('error','This is not your post');
        }
        return view('posts.edit' , compact('post'));
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
        $this->validate($request, [
            'title' => 'required|min:3',
            'body' => 'bail|required|min:3',
         ]);

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        return redirect('/posts/'.$post->id)->with('success','Post Updated successfully'); 
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
        $post = Post::find($id);
        if($post->user_id !==Auth::user()->id ){
            return redirect('posts')->with('error','This is not your post');
        }

        $del_post = Post::destroy($id);

        if ($del_post){
            session()->flash('success' , 'Post has been Deleted'); 
            return redirect('/posts');   
        }
    }
}
