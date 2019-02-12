@extends ('layouts.app')
@section('content')
    <h1>Edit Post</h1>
    {{--to edit and update --}}
    {{--to know which one is update ($post->id)--}}
    {!! Form::open(['action' => ['PostsController@update',$post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data'] ) !!}

    {{--bootstrap--}}
    <div class="form-group">
        {{Form::label('title', 'Title')}}

        {{--($post->title) ni utk pnggil blk apa yang ad dlm database utk edit--}}
        {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
    </div>

    <div class="form-group">
        {{Form::label('body', 'Body')}}

        {{--utk text area biasa without ckeditor--}}
        {{--{{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body Text'])}}--}}

        {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'placeholder' => 'Body Text'])}}

    </div>
    {{--utk add browse any file or image--}}
    <div class="form-group">
        {{Form::file('cover_image')}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}

    {!! Form::close() !!}
    @endsection