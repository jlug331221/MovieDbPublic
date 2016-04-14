@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1" >
                @foreach($reviews as $review)
                    @include('reviews.reviewComponent')
                @endforeach
            </div>
        </div>
    </div>

@endsection