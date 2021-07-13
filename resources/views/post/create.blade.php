@extends('layouts.app')

@section('content')
<div class="card-header">
    <h1>{{__('add_post')}}</h1>
</div>
<div class="card-body">
    <form action="/post" method="post">
        @csrf
        <div class="form-group">
            <input required="required" value="{{ old('title') }}" placeholder="Enter title here" type="text"
                name="title" class="form-control" />
        </div>
        <div class="form-group">
            <textarea name='body' class="form-control" id="textarea">{{ old('body') }}</textarea>
        </div>
        <input type="submit" name='publish' class="btn btn-success" value="{{__('Publish')}}" />
        <input type="submit" name='save' class="btn btn-default" value="{{__('Save Draft')}}" />
    </form>
</div>
@endsection