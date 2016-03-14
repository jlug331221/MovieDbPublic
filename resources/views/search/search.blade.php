@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Search Results</div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">Title</li>
                            @foreach($movies as $movie)
                                <li class="list-group-item">{!! $movie->title !!}</li>
                            @endforeach
                        </ul>	
                </div>
            </div>
        </div>
    </div>
</div>
@stop
