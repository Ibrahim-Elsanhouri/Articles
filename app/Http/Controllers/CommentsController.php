<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;

use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->role_id == 1 ){
            $comments = Comment::all();
            return view   ('comments.index' , compact('comments'));
        }
  
return redirect ('/home')->with('error','this area is for admins only');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
      
        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->commentable_type = $request->input('commentable_type');
        $comment->commentable_id = $request->input('commentable_id'); 
        $comment->user_id = Auth::user()->id;
        $comment->save();
        return redirect()->back()->with('success','Comments created successfully , we will wait for admin approval');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $comment = Comment::find($id);
        if(Auth::user()->role_id != 1 ){
            return redirect('home')->with('error','this for admin areas only');
        }
        return view('comments.edit' , compact('comment'));
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
        
     

        $comment = Comment::find($id);
        $comment->approved = $request->input('approved');
        $comment->body = $request->input('body');
        $comment->save();
        return redirect('/comments')->with('success','Comment Updated successfully'); 
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
     

        $del_comment = Comment::destroy($id);

        if ($del_comment){
            session()->flash('success' , 'Comment has been Deleted'); 
            return redirect('/comments');   
        }
    }
}
