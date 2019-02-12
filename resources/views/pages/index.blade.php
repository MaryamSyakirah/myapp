{{--extends from the layout-->app.blade.php (the header of html in this)--}}
@extends('layouts.app')

{{--section 'content' from the app.blade.php <body>@yield('content)'</body>--}}
@section('content')
    <div class="jumbotron text-center">
        {{--<h1> Welcome to Laravel </h1>--}}
        {{--declare $title in the controller-->pagecontroller.php--}}
        <h1>{{$title}}</h1>
        <p>This is the laravel application from the "Laravel from scratch" youtube series</p>
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
    </div>
@endsection