<!-- Chris created file on $(DATE) -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

@extends('layouts.app')

@section('content')
    <div class="container Review__container-all">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 Review__movie-link">
                <h3><a href="">{{$movieTitle}}</a> >> Review #{{$review->id}}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1 col-md-offset-1 Review__vote-container" id="voteContainer" logged="{{$logged}}">
                <div class="row">
                    <button type="button" class="btn btn-default Review__vote-button" onclick="upVote()" aria-label="Up Vote Review">
                        <span class="glyphicon glyphicon-chevron-up" id="upvote" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="row">
                    <div class="Review__vote-text">
                        <span id="voteText" value="{{$voted}}" rId = {{$review->id}} url="{{url('reviews')}}">{{$review->score}}</span>
                    </div>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-default Review__vote-button" onclick="downVote()" aria-label="Up Vote Review">
                        <span class="glyphicon glyphicon-chevron-down" id="downvote" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
            <div class="col-md-8 Review__review-container">
                <div class="panel panel-default">
                    <div class="panel-heading Review__panel-heading">
                        <div class="row">
                            <div class="Review__titleBar">
                                <div class="col-md-8 Review__title">
                                    <div class="col-md-10 Review__title-container">
                                        {{$review->title}}
                                    </div>
                                </div>
                                <div class="col-md-2 col-md-offset-2">
                                    <form class="form-horizontal Review__commentForm" action="{{ url('reviews/newcomment/'.$review->id ) }}" method="POST" role="form">
                                        {!! csrf_field() !!}
                                        @if(Auth::check())<button class="btn btn-primary">Comment</button>@endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body Review__panelBody">
                        <div class="Review__userDisplay col-md-3">
                                <div class="row Review__userAvatar">
                                    <img src="{{asset($review->avatar)}}" >
                                </div>
                                <div class="row Review__userName">
                                    <strong>{{$review->user()->firstOrFail()->name}}</strong>
                                </div>
                                <div class="row Review__createdAt">
                                    Posted: {{$review->created_at}}
                                </div>
                                <div class="row">
                                    <div class="Review__editDelete">
                                        @if(Auth::check())
                                            @if(Auth::user()->id === $review->user_id || Auth::user()->hasRole(['Comment Moderator', 'Review Moderator']))
                                                <button type="button" onclick="editReview()">
                                                <span>edit</span>
                                                </button>
                                                -
                                                <button type="button" onclick="deleteReview()">
                                                <span>delete</span>
                                                </button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                        </div>
                        <div class="Review__content col-md-9">
                            <div class="row Review__rating">
                                @for($i = 0; $i < $review->rating; $i++)
                                    <img src="{{asset('static/star.png')}}">
                                @endfor
                                @for($y = 0; $y < 10 - $review->rating; $y++)
                                        <img src="{{asset('static/white-star.png')}}">
                                    @endfor
                            </div>
                            <div class="Review__body row">
                                {{$review->body}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($comments as $comment)
            <div class="row" id="{{$comment->id}}" url="{{url('reviews')}}">
                <div class="col-md-8 col-md-offset-2 Review__comment-container">
                    <div class="panel panel-default">
                        <div class="panel-body Review__panelBody">
                            <div class="col-md-3 Review__userDisplay">
                                    <div class="Review__userAvatar row">
                                        <img src="{{asset($comment->avatar)}}">
                                    </div>
                                    <div class="Review__userName row">
                                        <strong>{{$comment->user()->firstorfail()->name}}</strong>
                                    </div>
                                    <div class="Review__createdAt row">
                                        <div>
                                            Posted: {{$comment->created_at}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="Review__editDelete">
                                            @if(Auth::check())
                                                @if(Auth::user()->id === $comment->user_id || Auth::user()->hasRole(['Comment Moderator', 'Review Moderator']))
                                                    <button type="button">
                                                        <span>edit</span>
                                                    </button>
                                                    -
                                                    <button type="button" onclick="deleteComment({{$comment->id}})">
                                                        <span>delete</span>
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                            </div>
                            <div class="Review__content col-md-9">
                                <div class="Review__body">
                                    {{$comment->body}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

<script>
    function deleteComment(id)
    {
        if(confirm("Are you sure you want to delete this comment?")) {
            var xhttp = new XMLHttpRequest();
            var url = document.getElementById(id).getAttribute("url");
            var fullUrl = url + "/deleteComment/" + id;
            xhttp.open("GET", fullUrl, true);
            xhttp.send();

            document.getElementById(id).style.display = "none";
        }
    }

    function upVote()
    {
        var voted = parseInt(document.getElementById("voteText").getAttribute("value"));
        var value = parseInt(document.getElementById("voteText").innerHTML);
        var url = document.getElementById("voteText").getAttribute("url") + "/handleVote";
        var ONE = 1;
        var ZERO = 0;
        var xhttp = new XMLHttpRequest();
        var fullUrl;
        var reviewId = document.getElementById("voteText").getAttribute("rId");
        var logged = document.getElementById("voteContainer").getAttribute("logged");

        //If user is not logged in
        if(logged == 0)
        {
            notLoggedIn();
        }

        if(voted == 0 || voted == -1)
        {
            if(voted == 0)
            {
                value++;
                fullUrl = url + "/1" + "&" + reviewId;
                xhttp.open("GET", fullUrl, true);
                xhttp.send();

            }
            else
            {
                value = value + 2;
                fullUrl = url + "/2" + "&" + reviewId;
                xhttp.open("GET", fullUrl, true);
                xhttp.send();
            }

            document.getElementById("voteText").innerHTML = value.toString();
            document.getElementById("upvote").style.color = "Red";
            document.getElementById("downvote").style.color = "Black";
            document.getElementById("voteText").setAttribute("value", "1");
        }
        else if(voted == 1)
        {
            //User is undoing their vote
            document.getElementById("upvote").style.color = "Black";
            value--;
            document.getElementById("voteText").innerHTML = value.toString();
            document.getElementById("voteText").setAttribute("value", "0");

            //Send ajax 0
            fullUrl = url + "/0" + "&" + reviewId;
            xhttp.open("GET", fullUrl, true);
            xhttp.send();
        }
    }

    //If logged in user clicks downvote button while they have not voted, the button turns blue
    //and the reviews score goes down by one. If they have already upvoted the post, the upvote
    //button turns black again and the blue button turns blue, the reviews score goes down by 2.
    //If the downvote button is already clicked, and then clicked again, the score returns to
    //what it was orignially.These changes are reflected in the database through ajax calls.
    function downVote()
    {
        var voted = parseInt(document.getElementById("voteText").getAttribute("value"));
        var value = parseInt(document.getElementById("voteText").innerHTML);
        var xhttp = new XMLHttpRequest();
        var url = document.getElementById("voteText").getAttribute("url") + "/handleVote";
        var reviewId = document.getElementById("voteText").getAttribute("rId");
        var NEGONE = 1;
        var ZER0 = 0;
        var logged = document.getElementById("voteContainer").getAttribute("logged");

        //If user is not logged in
        if(logged == 0)
        {
            notLoggedIn();
        }

        var fullUrl;
        if(voted == 0 || voted == 1)
        {
            if(voted == 0)
            {
                value--;
                fullUrl = url + "/-1" + "&" + reviewId;
                xhttp.open("GET", fullUrl, true);
                xhttp.send();

            }
            else
            {
                value = value - 2;
                fullUrl = url + "/-2" + "&" + reviewId;
                xhttp.open("GET", fullUrl, true);
                xhttp.send();
            }
            document.getElementById("voteText").innerHTML = value.toString();
            document.getElementById("upvote").style.color = "Black";
            document.getElementById("downvote").style.color = "Blue";
            document.getElementById("voteText").setAttribute("value", "-1");

        }
        else if(voted == -1)
        {
            document.getElementById("downvote").style.color = "Black";
            value ++;
            document.getElementById("voteText").innerHTML = value.toString();
            document.getElementById("voteText").setAttribute("value", "0");

            fullUrl = url + "/0" + "&" + reviewId;
            xhttp.open("GET", fullUrl, true);
            xhttp.send();
        }

    }

    function notLoggedIn()
    {
        alert("Please log in to vote on a review.");
    }

    function deleteReview()
    {
        var reviewId = document.getElementById("voteText").getAttribute("rId");
        var url = document.getElementById("voteText").getAttribute("url");

        if(confirm("Are you sure you want to delete this review?"))
        {
            //User presses yes
            var xhttp = new XMLHttpRequest();
            url = url + "/delete" + "/" + reviewId;
            xhttp.open("GET", url, true);
            xhttp.send();
            window.setTimeout(reviewDeleted(reviewId), 2500);
            location.reload();
        }
    }

    function reviewDeleted(reviewId)
    {
        alert("Review "+ reviewId + " has been deleted.");
    }

    $( document ).ready(function(){
        var voted = parseInt(document.getElementById("voteText").getAttribute("value"));

        if(voted == 1)
        {
            document.getElementById("upvote").style.color = "Red";
        }
        else if(voted == -1)
        {
           document.getElementById("downvote").style.color = "Blue";
        }
    });
</script>