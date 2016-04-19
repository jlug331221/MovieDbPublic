@extends('layouts.app')

@section('content')
<div>
    <div class = "container">
        <h1>
            <a>{{$discussion->title}}</a>
        </h1>
        <div class = "rightTop">
            by <a>{{Auth::user()->name}}</a>
            <hr/>
        </div>
    </div>

    <div class = "container">
        <div class = "leftBoard">
            <p>
                <a>{{$discussion->body}}</a>
            </p>
        </div>
        <hr/>
    </div>
    <div class="form-group">
        <form class="col-md-offset-1" action="{{ url('discussions/newreply/'.$discussion->id ) }}" method="POST" role="form">
            {!! csrf_field() !!}
            @if(Auth::check())<button class="btn btn-primary">Post a Reply</button>@endif
        </form>
    </div>
    <hr/>
    <div class="container">
        <h1>Replies</h1>
    </div>
    @foreach ($replies as $reply)
        <div class =  "container">
            <a>{{$reply->discussion_id}}</a>
            <a>{{$reply->user_id}}</a>
            <a>{{$reply->body}}</a>
            <hr/>
        </div>
    @endforeach

</div>

@endsection