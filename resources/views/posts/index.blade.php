@extends('layouts.app')
{{--bila click blog dia akan keluar semua post--}}
@section('content')
    <h3>Posts</h3>
    <hr>
    {{--posts declare in PostsController--}}
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        {{--/posts/___________ utk pergi ke page lain bila click tajuk tu--}}
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>Written on : {{$post->created_at}} by  {{$post->user->name}}</small>
                    </div>
                </div>

            </div>
        @endforeach
        {{--utk buat page--}}
        {{$posts->links()}}
    @else
            <p>No posts found</p>
    @endif
@endsection