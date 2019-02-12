@extends ('layouts.app')
{{--using laravel collection--}}
@section ('content')
    <h1>Create Post</h1>
    {{--to save in the database postscontroller@store--}}
    {{--'enctype' => 'multipart/data'] ) !!} utk masukkan file/gmbr time create--}}
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data'] ) !!}

    {{--bootstrap--}}
        <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>

        <div class="form-group">
        {{Form::label('body', 'Body')}}
            {{--utk text area biasa without ckeditor--}}
            {{--{{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body Text'])}}--}}
            {{--'' utk terima any word--}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'placeholder' => 'Body Text'])}}
        </div>
        {{--utk add browse any file or image--}}
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>

        {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}

        {!! Form::close() !!}
@endsection