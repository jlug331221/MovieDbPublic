@extends('layouts.app')

@section('content')
<div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $name }}, Welcome To Your User Page!
                </div>

                @if($errors->has())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{ $error }}<br/>
                        @endforeach
                    </div>
                @endif

                <div class="panel-body">
                    @if (\Illuminate\Support\Facades\Session::has('message'))
                        <div class="alert-success Userpage__messages">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{\Illuminate\Support\Facades\Session::get('message')}}
                        </div>
                    @endif
                    @if (\Illuminate\Support\Facades\Session::has('alert'))
                        <div class="alert-danger Userpage__messages">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{\Illuminate\Support\Facades\Session::get('alert')}}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-2 col-centered Userpage__center">
                            <p class="text-center">You are logged in! {{ Auth::user()->name }} </p>
                            <a href="{{ url('/userpage/avatar') }}" id="Userpage__avatar__edit">
                                <img src="{{asset($avatar)}}" class="img-circle Userpage__avatar" alt="Avatar">
                            </a>
                        </div>
                    </div>

                    <br>
                    <div class="container-fluid">
                        <ul class="nav nav-tabs" id="myTabs">
                            <li class="active"><a href="#create" data-toggle="tab"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;New List</a></li>
                            <li><a href="#movie" data-toggle="tab"><span class="glyphicon glyphicon-film" aria-hidden="true"></span>&nbsp;Movie Lists</a></li>
                            <li><a href="#person" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Person Lists</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="create">
                                <br/>
                                {!! Form::open(array('url' => '/userpage/home/newList')) !!}
                                    <div class="form-group">
                                        {!! Form::label('title', 'Title:') !!}
                                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::select('type', array('M' => 'Movie', 'P' => 'Person'), null,
                                                         ['placeholder' => 'Pick a list type...', 'class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::submit('Create List', ['class' => 'btn btn-primary form-control']) !!}
                                    </div>
                                {!! Form::close() !!}
                            </div>

                            <div class="tab-pane" id="movie">
                                <div class="accordion panel-group" id="accordion2">
                                <br>
                                <br>
                                @foreach($masterlists as $masterlist)
                                    @if($masterlist->type == "M")
                                        @foreach($masterlist->movielist as $movlist)
                                            <div class="accordion-group">
                                                <div class="panel panel-default">
                                                <div class="accordion-heading panel-heading ">
                                                    <div class="panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse{{$masterlist["id"]}}">
                                                        {{$masterlist["title"]}}&nbsp;
                                                    </a>
                                                    <span class="badge">{{count($movlist->movies)}}</span>
                                                    <button type="button" class="btn btn-default btn-sm pull-right">
                                                        <a href="{{ url('userpage/home/deleteList/'.$masterlist->id) }}" onclick="return confirm('Are you sure you want to delete list?')">
                                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                         </a>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-sm pull-right" data-title="{{$masterlist->title}}" data-id="{{$movlist->id}}" data-toggle="modal" data-target="#myMovieModal">
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                                    </button>
                                                    </div>
                                                </div>
                                                <div id="collapse{{$masterlist["id"]}}" class="accordion-body collapse" style="height: auto; ">
                                                    <div class="accordion-inner panel-body">
                                                        <ul class="list-group" data-movielist-id="{{ $movlist->id }}">
                                                            @foreach($movlist->movies as $movie)
                                                            <li class="list-group-item" data-movie-id="{{ $movie->id }}">
                                                                <a href="/movies/{{ $movie->id }}">
                                                                    @if($movie->album()->first()->defaultImage()->first() == null)
                                                                    <img class="Userpage__listThumbnail" src="/static/null_movie_125_175.png">
                                                                    @elseif($movie->album()->first()->defaultImage()->first()->getThumbPath() != null)
                                                                    <img class="Userpage__listThumbnail" src="{{ $movie->album()->first()->defaultImage()->first()->getThumbPath() }}" />
                                                                    @endif
                                                                    {{$movie["title"]}}
                                                                </a>
                                                                <a href="{{ url('userpage/home/deleteMovieItem/'.$movie->id).'/'.$movlist->id }}">
                                                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                                </a>
                                                            </li>
                                                            </br>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                    <br>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Movie Modal -->
                            <div class="modal fade" id="myMovieModal" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" id="listMovieModal"></h4>
                                        </div>
                                        <div class="modal-body">
                                            {!! Form::open() !!}
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control"
                                                       placeholder="Search"
                                                       id="UserpageMovie__input">
                                                {!! Form::hidden('listid', null, ['class' => 'form-control', 'id' => 'list_id']) !!}
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Person Modal -->
                            <div class="modal fade" id="myPersonModal" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" id="listPersonModal"></h4>
                                        </div>
                                        <div class="modal-body">
                                            {!! Form::open() !!}
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control"
                                                       placeholder="Search"
                                                       id="UserpagePerson__input">
                                                {!! Form::hidden('listid', null, ['class' => 'form-control', 'id' => 'list_id']) !!}
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="person">

                                <div class="accordion2 panel-group" id="accordion3">
                                    @foreach($masterlists as $masterlist)
                                        @if($masterlist->type == "P")
                                            @foreach($masterlist->personlist as $perlist)
                                                <div class="accordion-group">
                                                    <div class="panel panel-default">
                                                        <div class="accordion-heading panel-heading ">
                                                            <div class="panel-title">
                                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse{{$masterlist["id"]}}">
                                                                    {{$masterlist["title"]}}&nbsp;
                                                                </a>
                                                                <span class="badge">{{count($perlist->people)}}</span>
                                                                <button type="button" class="btn btn-default btn-sm pull-right">
                                                                    <a href="{{ url('userpage/home/deleteList/'.$masterlist->id) }}" onclick="return confirm('Are you sure you want to delete list?')">
                                                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                                    </a>
                                                                </button>
                                                                <button type="button" class="btn btn-default btn-sm pull-right" data-title="{{$masterlist->title}}" data-id="{{$perlist->id}}" data-toggle="modal" data-target="#myPersonModal">
                                                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div id="collapse{{$masterlist["id"]}}" class="accordion-body collapse" style="height: auto; ">
                                                            <div class="accordion-inner panel-body">
                                                                <ul class="list-group" data-peoplelist-id="{{ $perlist->id }}">
                                                                    @foreach($perlist->people as $person)
                                                                    <li class="list-group-item" data-person-id="{{ $person->id }}">
                                                                        <a href="/people/{{ $person->id }}">
                                                                            @if($person->album()->first()->defaultImage()->first() == null)
                                                                                <img class="Userpage__listThumbnail" src="/static/null_person_125_175.png">
                                                                            @elseif($movie->album()->first()->defaultImage()->first()->getThumbPath() != null)
                                                                                <img class="Userpage__listThumbnail" src="{{ $person->album()->first()->defaultImage()->first()->getThumbPath() }}" />
                                                                            @endif
                                                                            {{$person->getBestName()}}
                                                                        </a>
                                                                        <a href="{{ url('userpage/home/deletePersonItem/'.$person->id).'/'.$perlist->id }}">
                                                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                                        </a>
                                                                    </li>
                                                                    </br>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

