@extends('layouts.app')
@section('content')
<div class="card-header">
    <h2>
        {{$user->name}}
    </h2>
</div>
<div class="card-body">
    <div>
        <ul class="list-group">
            <li class="list-group-item">
                {{__('Joined_on')}} {{$user->created_at->format('M d,Y \a\t h:i a') }}
            </li>
            <li class="list-group-item panel-body">
                <table class="table-padding">
                    <tr>
                        <td style="padding-right:50px;">{{__('Total_Post')}}</td>
                        <td style="padding-right:20px;">{{$total_post}}</td>
                        @if(Auth::user() && $total_post > 0)
                        <td><a href="{{asset('/post/my-all-posts/user')}}/{{$user->id}}">{{__('Show_All')}}</a>
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <td>{{__('Published_Post')}}</td>
                        <td>{{$published_post}}</td>
                        @if($published_post > 0)
                        <td><a href="{{asset('/user')}}/{{$user->id}}/post">{{__('Show_All')}}</a></td>
                        @endif
                    </tr>
                    <tr>
                        <td>{{__('Posts_in_Draft')}} </td>
                        <td>{{$posts_in_Draft}}</td>
                        @if(Auth::user() && $posts_in_Draft > 0)
                        <td><a href="{{asset('/post/my-draft/user')}}/{{$user->id}}">{{__('Show_All')}}</a></td>
                        @endif
                    </tr>
                </table>
            </li>
            <li class="list-group-item">
                {{__('Total_Comment')}}: {{$total_comment}}
            </li>
        </ul>
    </div>
    <div class="card" style="margin-top: 20px;">
        <div class="card-header">
            <h2>
                {{__('Latest Post')}}
            </h2>
        </div>
        <div class="card-body">
            @if(!empty($latest_posts[0]))
            @foreach($latest_posts as $latest_post)
            <p>
                <strong><a href="{{ url('/post/'.$latest_post->id) }}">{{ $latest_post->title }}</a></strong>
                <span class="well-sm"> On {{ $latest_post->created_at->format('M d,Y \a\t h:i a') }}</span>
            </p>
            @endforeach
            @else
            <p>{{__('Post_Null')}}</p>
            @endif
        </div>
    </div>
    <div class="card" style="margin-top: 20px;">
        <div class="card-header">
            <h2>
                {{__('Latest_Comment')}}
            </h2>
        </div>
        <div class="list-group">
            @if(!empty($latest_comments[0]))
            @foreach($latest_comments as $latest_comment)
            <div class="list-group-item">
                <p>{{ $latest_comment->body }}</p>
                <p>On {{ $latest_comment->created_at->format('M d,Y \a\t h:i a') }}</p>
                <p>{{__('On_Post')}} <a href="{{ url('/post/'.$latest_comment->id) }}">{{ $latest_comment->title }}</a>
                </p>
            </div>
            @endforeach
            @else
            <div class="list-group-item">
                <p>{{__('Comment_Null')}}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection