@extends('layouts.app')

<?php 
    $default = $person->album()->firstOrFail()->defaultImage()->first();
?>

@section('content')
    <div class="container">
        <div class="Album__header">
            <div class="Album__header--default-img">
                @if ($default)
                    <a href="{{ $default->getPath() }}"
                       data-lightbox="default"
                       data-title="{{ $default->description }}">
                        <img src="{{ $default->getThumbPath() }}">
                    </a>
                @else
                    <img src="/static/null_person_125_175.png">
                @endif
            </div>
            <div class="Album__header--text">
                <div class="Album__header--title">
                    <a href="{{ url('/people', $person->id) }}">
                        {{ $person->getBestName() }} 
                    </a>
                </div>
                <div class="Album__header--date">
                    {{ $person->getBirthAndDeathYears() }}
                </div>
            </div>
        </div>

        <hr class="Album__separator"/>

        <div class="Album" data-id="{{ $person->album()->firstOrFail()->id }}"></div>

    </div>

@stop
