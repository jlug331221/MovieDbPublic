@extends('layouts.app')

@section('content')

    <div class="container Review__container">
        <div class="Review__notFound-Box">
            <div class="row">

            </div>
            <div class="row">
                <div class="Review__notFound-Picture">
                    @if($missing === 'movie')
                        <img src="{{asset('static/movie-missing.png')}}" class="Review__notFound-Movie">
                    @else
                        <img src="{{asset('static/review-missing.png')}}" class="Review__notFound-Review">
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="Review__notFound-Text">
                    @if($missing === 'movie')
                        <p>Uh-oh! The movie you requested cannot be found.</p>
                    @else
                        <p>Uh-oh! The review you requested cannot be found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection