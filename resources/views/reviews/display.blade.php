<!-- Chris created file on $(DATE) -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3><a href="">{{$movieTitle}}</a> >> Review #{{$review->id}}</h3>
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
                            <div class="col-md-2 col-md-offset-2" style="margin-top: 4px;">
                                <form class="form-horizontal" action="{{ url('reviews/newcomment/'.$review->id ) }}" method="POST" role="form" style="margin-bottom:0px;">
                                    {!! csrf_field() !!}
                                    @if(Auth::check())<button class="btn btn-primary">Comment</button>@endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="reviewdisplay col-md-3">
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
                        <div class="reviewdisplay col-md-9" style="padding-left: 30px; border-left: 1px solid #ddd;">
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
            <div class="row" >
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-3">
                                <div class="commentdisplay">
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
                            <div class="col-md-9" style="padding-left: 30px; border-left: 1px solid #ddd;">
                                <div class="commentdisplay">
                                    {{$comment->body}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        $( document ).ready(function() {
        var commentHeights = $(".commentdisplay").map(function() {
        return $(this).height();
        }).get(),

        maxHeight = Math.max.apply(null, commentHeights);

        $(".commentdisplay").height(maxHeight);
        });

        $( document ).ready(function() {
            var reviewHeights = $(".reviewdisplay").map(function () {
                        return $(this).height();
                    }).get(),

                    maxReviewHeight = Math.max.apply(null, reviewHeights);

            $(".reviewdisplay").height(maxReviewHeight);
        });
    </script>
@endsection