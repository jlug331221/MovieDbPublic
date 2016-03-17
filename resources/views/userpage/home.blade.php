@extends('layouts.app')

@section('content')
<div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $name }}, Welcome To Your User Page!</div>

                @if($errors->has())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{ $error }}<br/>
                        @endforeach
                    </div>
                @endif

                <div class="panel-body">

                    <!-- USER AVATAR  -->
                    @if($avatar != '/.')
                    <div class="row">
                        <div class="col-lg-12 col-centered">
                            <p class="text-center">You are logged in! {{ Auth::user()->name }} </p>
                            <a href="{{ url('/userpage/avatar') }}">
                                <img src="{{asset($avatar)}}" class="img-circle center-block Userpage__avatar" alt="Avatar">
                            </a>
                        </div>
                    </div>
                    @endif
                    @if($avatar == '/.')
                    <div class="row">
                        <div class="col-lg-12 col-centered">
                           <p class="text-center">You are logged in! {{ Auth::user()->name }} </p>
                            <a href="{{ url('/userpage/avatar') }}" class="icon">
                                <img src= "{{url('/public/images/icon_user-default.png')}}" class="img-circle center-block Userpage__avatar" alt="Avatar">
                            </a>
                        </div>
                    </div>
                    @endif
                    <!-- USER AVATAR  -->

                    <br>
                    <div class="container-fluid">
                        <ul class="nav nav-tabs" id="myTabs">
                            <li class="active"><a href="#create" data-toggle="tab">Create List</a></li>
                            <li><a href="#movie" data-toggle="tab">My Movie Lists</a></li>
                            <li><a href="#person" data-toggle="tab">My Person Lists</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="create">
                                <br/>
                                {!! Form::open() !!}
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
                                <br>
                                <div class="panel-group" id="accordion">
                                    @foreach($masterlists as $masterlist)
                                        @if($masterlist->type == "M")
                                            @foreach($masterlist->movielist as $movlist)
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <div class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse">{{$masterlist["title"]}}</a>
                                                            <button type="button" class="btn btn-default btn-sm pull-right">
                                                                <a href="{{ url('userpage/home/deleteList/'.$masterlist->id) }}">
                                                                    <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span> Delete List
                                                                </a>
                                                            </button>
                                                        </div>

                                                    </div>
                                                    <div id="collapse" class="panel-collapse collapse in">
                                                        <div class="panel-body">
                                                            @foreach($movlist->movies as $movie)
                                                            {{$movie["title"]}}
                                                            </br>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="tab-pane" id="person">
                                <br>
                                <div class="panel-group" id="accordion">
                                    @foreach($masterlists as $masterlist)
                                        @if($masterlist->type == "P")
                                            @foreach($masterlist->personlist as $perlist)
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <div class="panel-title">
                                                            <a data-toggle="collapse2" data-parent="#accordion" href="#collapse2">{{$masterlist["title"]}}</a>
                                                            <button type="button" class="btn btn-default btn-sm pull-right">
                                                                <a href="{{ url('userpage/home/deleteList/'.$masterlist->id) }}">
                                                                    <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span> Delete List
                                                                </a>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div id="collapse2" class="panel-collapse collapse in">
                                                        <div class="panel-body">
                                                            @foreach($perlist->people as $person)
                                                                {{$person["first_name"]}}
                                                                {{$person["last_name"]}}
                                                                </br>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
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
