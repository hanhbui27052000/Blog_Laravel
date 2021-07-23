<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;
class CommentController extends Controller
{
   public function store(Request $request){
       $comment = new Comment();
       $comment->user_id = Auth::user()->id;
       $comment->body = $request->body;
       $comment->post_id = $request->post_id;
       $comment->save();
       return redirect('/post/'.$request->post_id)->withMessage(__('Comment_success'));  
   }

   public function delete(Request $request,$id){
       $comment = Comment::find($id);
       if(Auth::user()->id != $comment->user_id || Auth::user()->role == 'subscriber'){
        return redirect('/post/'.$comment->post_id)->withErrors(__('permission_comment'));
       }
       else{
            $comment->delete();
            return Redirect()->back()->withMessage(__('comment_delete'));
       }
}
}