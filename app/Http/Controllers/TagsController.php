<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;
use Illuminate\Support\Facades\Auth;


class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->role_id == 1){
            $tags = Tag::orderBy('created_at', 'DESC')->paginate(5);
            return view('tags.index', compact('tags'));
        }
        return redirect('/home')->with('error','This area for admins only  ');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::user()->role_id == 1){

        return view ('tags.create');
    }
    return redirect('/home')->with('error','This area for admins only  ');

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
            'desc' => 'bail|required|min:3',
         ]);
        $tag = new tag();
        $tag->title = $request->input('title');
        $tag->desc = $request->input('desc');
        $tag->save();
        return redirect('/tags')->with('success','Tag Added Successfully ');

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
if (Auth::user()->role_id == 1){
        $tag = Tag::find($id);
        return view('tags.show' , compact('tag'));
}
        return redirect('/home')->with('error','This area for admins only  ');

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
    }
}
