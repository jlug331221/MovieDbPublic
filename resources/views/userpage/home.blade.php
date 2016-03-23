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
                                <br>
                                <div class="accordion panel-group" id="accordion2">
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
                                                        <a href="{{ url('userpage/home/deleteList/'.$masterlist->id) }}">
                                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                         </a>
                                                    </button>
                                                    </div>
                                                </div>
                                                <div id="collapse{{$masterlist["id"]}}" class="accordion-body in collapse" style="height: auto; ">
                                                    <div class="accordion-inner panel-body">
                                                        <ul class="list-group">
                                                            @foreach($movlist->movies as $movie)
                                                            <li class="list-group-item">
                                                                {{$movie["title"]}}
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
                                                                    <a href="{{ url('userpage/home/deleteList/'.$masterlist->id) }}">
                                                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                                    </a>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div id="collapse{{$masterlist["id"]}}" class="accordion-body in collapse" style="height: auto; ">
                                                            <div class="accordion-inner panel-body">
                                                                <ul class="list-group">
                                                                    @foreach($perlist->people as $person)
                                                                    <li class="list-group-item">
                                                                        {{$person["first_name"]}}
                                                                        {{$person["last_name"]}}
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
