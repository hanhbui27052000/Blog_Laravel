@extends('layouts.app')

@section('content')
<div class="card-header">
    <h1>{{__('Edit Post')}}</h1>
</div>
<div class="card-body">
    <form method="post" action='{{ url('/post/'.$getPostById->id) }}'>
        @csrf
        @method('PUT')
        <input type="hidden" name="post_id" value="{{$getPostById->id}}">
        <div class="form-group">
            <input required="required" placeholder="Enter title here" type="text" name="title" class="form-control"
                value="@if(!old('title')){{$getPostById->title}}@endif{{ old('title') }}" />
        </div>
        <div class="form-group">
            <textarea name='body' class="form-control" id="textarea">
      @if(!old('body'))
      {!! $getPostById->body !!}
      @endif
      {!! old('body') !!}
    </textarea>
        </div>
        @if($getPostById->active == '1')
        <input type="submit" name='publish' class="btn btn-success" value="{{__('Update')}}" />
        @else
        <input type="submit" name='publish' class="btn btn-success" value="{{__('Publish')}}" />
        @endif
        <input type="submit" name='save' class="btn btn-default" value="{{__('Save Draft')}}" />
        <input type="submit" class="btn btn-danger" value="{{__('Delete')}}" form="delete" />
    </form>
    <form action="{{ url('/post/'.$getPostById->id ) }}" method="post" id="delete">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection