<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Post;
use  App\User;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
$userId = Auth::user()->id;
$posts = Post::where('user_id', $userId)->get();
        return view('home', compact('posts'));
    }
}
