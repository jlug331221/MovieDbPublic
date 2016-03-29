@extends('layouts.app')

@section('content')
    <div>
        @include('search.searchWidget')
    </div>
    <div>
        <?php if(isset($movies)): ?>
            @include('search.searchResultsWidget')
        <?php endif ?>
    </div>
@stop
