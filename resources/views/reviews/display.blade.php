<!-- Chris created file on $(DATE) -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>{{$movieTitle}} >> Review #{{$review->id}}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-8">
                                <h4>{{$review->title}}</h4>
                            </div>
                            <div class="col-md-2 col-md-offset-2">
                                <form class="form-horizontal" action="{{ url('reviews/newcomment/'.$review->id ) }}" method="POST" role="form">
                                    {!! csrf_field() !!}
                                    @if(Auth::check())<button class="btn btn-primary">Comment</button>@endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-3">
                            <div>
                                <div class="row">
                                    <img src="{{asset('images/database-mysql.png')}}" style="height:170px; width:170px; margin-left:4px;" >
                                </div>
                                <div class="row" style="text-align:center;">
                                    <strong>{{$review->user()->firstOrFail()->name}}</strong>
                                </div>
                                <div class="row">
                                    <div style="text-align:center; font-size:12px;">
                                        Posted: {{$review->created_at}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div style="text-align:center; font-size:12px;">
                                        @if(Auth::check())
                                            @if(Auth::user()->id === $review->user_id || Auth::user()->hasRole(['Comment Moderator', 'Review Moderator']))
                                                <a href="">edit</a>
                                                -
                                                <a href="">delete</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <strong>Rating: {{$review->rating}}/10</strong>
                            </div>
                            <div class="row">
                                {{$review->body}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($comments as $comment)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-3">
                                <div>
                                    <div class="row">
                                        <img src="{{asset('images/database-mysql.png')}}" style="height:170px; width:170px; margin-left:4px;">
                                    </div>
                                    <div class="row" style="text-align:center;">
                                        <strong>{{$comment->user()->firstorfail()->name}}</strong>
                                    </div>
                                    <div class="row">
                                        <div style="text-align:center; font-size:12px;">
                                            Posted: {{$comment->created_at}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div style="text-align:center; font-size:12px;">
                                            @if(Auth::check())
                                                @if(Auth::user()->id === $comment->user_id || Auth::user()->hasRole(['Comment Moderator', 'Review Moderator']))
                                                    <a href="">edit</a>
                                                -
                                                    <a href="">delete</a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                {{$comment->body}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection