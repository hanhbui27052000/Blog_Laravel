<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
class UserController extends Controller
{
    public function profile($id){
        $user = User::find($id);
        $total_post = Post::where('user_id',$id)->count();
        $published_post = Post::where('user_id',$id)->where('active',1)->count();
        $posts_in_Draft = Post::where('user_id',$id)->where('active',0)->count();
        $total_comment = Comment::where('user_id',$id)->count();
        $latest_posts = Post::where('user_id',$id)->where('active',1)->paginate(5);
        $latest_comments = Comment::join('posts','posts.id','=','comments.post_id')
        ->where('comments.user_id',$id)
        ->select('comments.body','comments.created_at','posts.id','posts.title')
        ->paginate(5);
        return view('user.profile',compact('user','total_post','published_post','posts_in_Draft','total_comment','latest_posts','latest_comments'));
    }

    public function user_post_active($id){
        $users = User::find($id);
        $posts = Post::where('user_id',$id)->where('active',1)->orderBy('created_at')->get();
        return view('user.user_post_active',compact('users','posts'));
    }

    public function my_all_post($id){
        $users = User::find($id);
        $posts = Post::where('user_id',$id)->orderBy('created_at','desc')->paginate(5);
        return view('user.my_all_post',compact('users','posts'));
    }

    public function my_draft($id){
        $users = User::find($id);
        $posts = Post::where('user_id',$id)->where('active',0)->orderBy('created_at','desc')->paginate(5);
        return view('user.my_draft',compact('users','posts'));
    }
}