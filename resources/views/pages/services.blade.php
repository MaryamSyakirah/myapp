@extends('layouts.app')
@section('content')
    {{--to call title only in the $data--}}
<h1> {{$title}} </h1>
    {{--untuk keluarkan jenis service dalam $services dalam $data in pagescontroller.php--}}
    @if(count($services) > 0)
        <ul class="list-group">
            @foreach($services as $service)
                <li class="list-group-item">{{$service}}</li>
            @endforeach
                @endif
        </ul>

    <p>This is the services page</p>
    @endsection


