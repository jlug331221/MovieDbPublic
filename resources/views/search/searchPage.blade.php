@extends('layouts.app')

@section('content')
    <div>
        @include('search.searchWidget')
    </div>
    <div>
        <?php if(isset($movies)): ?>
            @include('search.searchResultsMoviesWidget')
        <?php endif ?>
    </div>
@stop
