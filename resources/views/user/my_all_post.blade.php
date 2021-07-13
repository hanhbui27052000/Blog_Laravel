@extends('layouts.app')
@section('content')
<div class="card-header">
    <h1>{{$users->name}}</h1>
</div>
@if (!empty($posts[0]))
@foreach($posts as $post)
<div class="card-body">
    <div class="list-group">
        <div class="list-group-item">
            <h3><a href="{{ url('/post/'.$post->id)}}">{{$post->title}}</a>
                @if(!Auth::guest() && ($post->user_id == Auth::user()->id ||
                Auth::user()->role == 'admin'))
                <button class="btn" style="float: right"><a
                        href="{{ url('/post/'.$post->id.'/edit')}}">{{__('Edit Post')}}</a></button>
                @endif
            </h3>
            <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a
                    href="{{ url('/user/'.$post->user_id)}}">{{ $post->users->name }}</a></p>
        </div>
        <div class="list-group-item">
            <article>
                {!! Str::limit($post->body, $limit = 1500, $end = '....... <a href='.url("/".$post->id).'>Read
                    More</a>') !!}
            </article>
        </div>
    </div>
    {{$posts->links()}}
</div>
@endforeach
@else
<div class="card-body">
    no posts yet
</div>
@endif
@endsection