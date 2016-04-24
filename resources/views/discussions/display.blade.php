@extends('layouts.app')

@section('content')
<div>
    <div class = "container">
        <h1>
            {{$discussion->title}}
        </h1>
        <div class = "rightTop">
            <p>by {{Auth::user()->name}}</p>
            <p>Created at: {{$discussion->created_at}}</p>
            <hr/>
        </div>
    </div>

    <div class = "container">
        <div class = "discussionBody">
            <p>
                {{$discussion->body}}
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
        <h1>Replies to {{$discussion->title}}</h1>
    </div>
    @foreach ($replies as $reply)
        <div class =  "container">
            <p>by: {{$reply->user()->firstorfail()->name}}</p>
            <p>Posted: {{$reply->created_at}}</p>
            <div id = "replyBody">
                <p>{{$reply->body}}</p>
            </div>
            <hr/>
        </div>
    @endforeach

</div>

@endsection