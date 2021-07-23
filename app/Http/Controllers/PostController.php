<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostFormRequest;
use App\Models\Post;
use App\Models\Comment;
use Auth;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role == 'subscriber')
        {
            return redirect('/home')->withErrors(__('permissions_post'));
        } 
        else {
            return view('post.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
        $duplicate = Post::where('title', $request->title)->first();
        if ($duplicate) {
            return redirect('/post/create')->withErrors(__('Title already exists'))->withInput();
        }
        else{
            if($request->has('publish')){
                $OBJ_Post = new Post();
                $OBJ_Post->user_id = Auth::user()->id;
                $OBJ_Post->title = $request->title;
                $OBJ_Post->body = $request->body;
                $OBJ_Post->active = 1;
                $OBJ_Post->save();
                $message = __('success_post');
            }
            else{
                $OBJ_Post = new Post();
                $OBJ_Post->user_id = Auth::user()->id;
                $OBJ_Post->title = $request->title;
                $OBJ_Post->body = $request->body;
                $OBJ_Post->active = 0;
                $OBJ_Post->save();
                $message = __('success_post_draft');
            }
        }
        return redirect('/post/' . $OBJ_Post->id .'/edit')->withMessage($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id',$id)->get(); 
        if(!$post){
            return redirect('/home')->withErrors(__('page_not_found'));
        }
        return view('post.show',compact('post','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $getPostById = Post::find($id);
        if(Auth::user()->id == $getPostById->user_id || Auth::user()->role == 'admin'){
            return view('post.edit',compact('getPostById'));
        }
        else{
            return redirect('/home')->withErrors(__('permissions_post'));
        } 
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
        $post = Post::find($request->post_id);
        if(Auth::user()->id == $post->user_id || Auth::user()->role == 'admin'){
            $duplicate = Post::where('title', $request->title)->where('id','!=',$post->id)->count();
            if ($duplicate > 0) {
                return redirect('/post/'.$post->id.'/edit')->withErrors(__('Title already exists'))->withInput();
            }
            else{
                $post->title = $request->title;
                $post->body = $request->body;
                if($request->has('save')){
                    $post->active = 0;
                    $message = __('save_post_draft');
                    $landing = '/post/'.$post->id.'/edit';
                }
                else{
                    $post->active = 1;
                    $message = __('update_post');
                    $landing = '/post/'.$post->id;
                }
            }
            $post->save();
            return redirect($landing)->withMessage($message);
        }
        else{
            return redirect('/home')->withErrors(__('permissions_post'));
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(Auth::user()->id == $post->user_id || Auth::user()->role == 'admin'){
            $post->delete();
            $data['message'] = __('post_delete');
        }
        else{
            $data['errors'] = __('error_delete_post');
        } 
        return redirect('/home')->with($data);
    }
}