@extends('layouts.app')
{{--this one for show for each post--}}
@section('content')
    <a href="/posts" class="btn btn-default">Go back</a>
    <h1>{{$post->title}}</h1>
    <div>
        {{--ni keluar dalam bntuk source code--}}
        {{--{{$post->body}}--}}
        {{--utk keluarkan dalam bntuk asal--}}
        <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
        <br><br>
        {!! $post->body !!}

    <br><br>
    </div>
    <hr>
    <small>Written on : {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>

    {{--dekat bhgn edit, if..end if ni utk buang button edit n delete kalau yg access tu tak sama dgn by dia--}}
    {{--if pertama utk kalau tekan blog dia akan view semua post, if tekan each post dia tk bg edit/delete selagi tk log in--}}
    @if(!Auth::guest())
        {{--if kedua ni utk kalau dah log in n tekan blog view semua post, dia akan boleh edit/delete yg dia punya shj--}}
        @if(Auth::user()->id == $post->user_id)
            <tr>
                {{--edit just call /posts/edit since have edit.blade.php--}}
                <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                {{--copy delete action from show.blade--}}
                <td>
                    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class'=> 'pull-right']) !!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                    {!! Form::close() !!}
                </td>
            </tr>

            @endif
    @endif
@endsection