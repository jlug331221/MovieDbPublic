@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container">
        <input type="text" class="form-control" id="jsonTest-input-post" placeholder="search by post">
        <hr />
        <button class="btn btn-primary" id="jsonTest-submit-post">post</button>
        <hr />
        <input type="text" class="form-control" id="jsonTest-input-get" placeholder="search by get">
        <hr />
        <button class="btn btn-primary" id="jsonTest-submit-get">get</button>
        <hr />
        {{--<input class="typeahead form-control" type="text" data-provider="typeahead" placeholder="typeahead">--}}
        <input class="form-control" type="text" id="search">
    </div>

@endsection