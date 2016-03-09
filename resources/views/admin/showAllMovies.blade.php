@extends('layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1>All Movies</h1>

                <hr/>

                @foreach($movies as $movie)
                    <h2>{{ $movie->title }}</h2>
                @endforeach

            </div>
        </div>
    </div>
@endSection