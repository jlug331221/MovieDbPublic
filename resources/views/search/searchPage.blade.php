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
    <div>
        <?php if(isset($people)): ?>
	    @include('search.searchResultsPeopleWidget')
	<?php endif ?>
    </div>
@stop
