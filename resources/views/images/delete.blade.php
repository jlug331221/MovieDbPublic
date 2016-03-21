@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Delete Image</h1>

        <hr>

        <p>{{ $image->getPath() }}</p>
        <p>{{ $image->description }}</p>
        <img src="{{ $image->getPath() }}">

        <hr>

        <a class="btn btn-primary"
           href="{{ url('/images/discard', $image->name) }}">
            Delete
        </a>
    </div>

@endsection