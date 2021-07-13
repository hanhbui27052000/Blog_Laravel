@extends('layouts.app')
@section('content')
<div class="card-header">
    <h1>{{__('Latest Post')}}</h1>
</div>
@if ($count_post == 0)
<div class="card-body">
    There is no post till now. Login and write a new post now!!!
</div>
@else
@foreach($list_posts as $list_post)
<div class="card-body">
    <div class="list-group">
        <div class="list-group-item">
            <h3><a href="{{ url('/post/'.$list_post->id)}}">{{$list_post->title}}</a>
                @if(!Auth::guest() && ($list_post->user_id == Auth::user()->id ||
                Auth::user()->role == 'admin'))
                <button class="btn" style="float: right"><a
                        href="{{ url('/post/'.$list_post->id.'/edit')}}">{{__('Edit Post')}}</a></button>
                @endif
            </h3>
            <p>{{ $list_post->created_at->format('M d,Y \a\t h:i a') }} {{__('by')}} <a
                    href="{{ url('/user/'.$list_post->user_id)}}">{{ $list_post->users->name }}</a></p>
        </div>
        <div class="list-group-item">
            <article>
                {!! Str::limit($list_post->body, $limit = 1500, $end = '....... <a href='.url("/".$list_post->id).'>Read
                    More</a>') !!}
            </article>
        </div>
    </div>
</div>
@endforeach
{{$list_posts->links()}}
@endif
@endsection