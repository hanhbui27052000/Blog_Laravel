@extends('layouts.app')

@section('content')
<div class="card-header">
    <h2>
        {{$post->title}}
        @if(!Auth::guest() && ($post->user_id == Auth::user()->id || Auth::user()->role == 'admin'))
        <button class="btn" style="float: right"><a
                href="{{ url('/post/edit/'.$post->id)}}">{{__('Edit Post')}}</a></button>
        @endif
    </h2>
    <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} {{__('by')}} <a
            href="{{ url('/user/'.$post->user_id)}}">{{ $post->users->name }}</a>
    </p>
</div>
<div class="card-body">
    <div>
        <p>{!! $post->body !!}</p>
    </div>
    <div>
        <h2>{{__('Leave a comment')}}</h2>
    </div>
    @if(Auth::guest())
    <p>{{__('Login to Comment')}}</p>
    @else
    <div class="panel-body">
        <form method="post" action="/comment/add">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">

            <div class="form-group">
                <textarea required="required" placeholder="Enter comment here" name="body"
                    class="form-control"></textarea>
            </div>
            <input type="submit" name='post_comment' class="btn btn-success" value="Post" />
        </form>
    </div>
    @endif
    <div style="margin-top: 40px;">
        <ul style="list-style: none; padding: 0">
            @foreach($comments as $comment)
            <li class="panel-body" style="margin-bottom: 40px;">
                <div class="list-group">
                    <div class="list-group-item">
                        <h3>
                            <a href="{{asset('/user')}}/{{$comment->user_id}}">{{ $comment->users->name }}</a>
                            @if(Auth::user()->id == $comment->user_id)
                            <button class="btn" style="float: right"><a
                                    href="{{ url('/comment/delete/'.$comment->id)}}">{{__('delete_comment')}}</a></button>
                            @endif
                        </h3>
                        <p>{{ $comment->created_at->format('M d,Y \a\t h:i a') }}</p>
                    </div>
                    <div class="list-group-item">
                        <p>{{ $comment->body }}</p>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection