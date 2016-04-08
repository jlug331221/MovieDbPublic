@extends('layouts.app')

<?php 
    $images = $album->images()->get(); 
    $default = $album->defaultImage()->first();
?>

@section('content')
    <div class="container">
        <div class="Album__header">
            <div class="Album__header--default-img">
                @if ($default)
                    <a href="{{ $default->getPath() }}"
                       data-lightbox="{{ $album->id }}"
                       data-title="{{ $default->description }}">
                        <img src="{{ $default->getThumbPath() }}">
                    </a>
                @else
                    <img src="/static/null_movie_125_175.png">
                @endif
            </div>
            <div class="Album__header--text">
                <div class="Album__header--title">
                    <a href="{{ url('/movies', $movie->id) }}">
                        {{ $movie->title }} 
                    </a>
                </div>
                <div class="Album__header--date">
                    ({{ substr($movie->release_date, 0, 4) }})
                </div>
            </div>
        </div>

        <hr class="Album__separator"/>

        <div class="Album">
            @foreach ($images as $image)
                @if (! ($image->id === $album->default))
                    <div class="AlbumPreview__thumb" 
                         title="{{ $image->description }}">
                        <a href="{{ $image->getPath() }}"
                           data-lightbox="{{ $album->id }}"
                           data-title="{{ $image->description }}">
                            <img src="{{ $image->getThumbPath() }}">
                        </a>
                    </div>
                @endif
            @endforeach
        </div>

    </div>

@stop
