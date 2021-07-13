<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $list_posts = Post::where('active',1)->orderBy('created_at','desc')->paginate(5);
        $count_post = Post::where('active',1)->count();
        return view('index',compact('list_posts','count_post'));
    }
}