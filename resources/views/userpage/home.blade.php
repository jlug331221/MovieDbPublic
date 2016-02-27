@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $name }}, Welcome To Your User Page!</div>

                <div class="panel-body">
                    You are logged in! {{ Auth::user()->name }}
                    <br>
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

                                Display accordion of movie list titles
                                <br>
                                <br>

                                <div class="panel-group" id="accordion">
                                    @foreach($masterlists as $masterlist)
                                        @if($masterlist->type == "M")
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">{{$masterlist["title"]}}</a>
                                                    </h4>
                                                </div>
                                                <div id="collapse1" class="panel-collapse collapse in">
                                                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                            </div>

                            <div class="tab-pane" id="person">

                                Display accordion of person list titles
                                <br>
                                <br>

                                <div class="panel-group" id="accordion">
                                    @foreach($masterlists as $masterlist)
                                        @if($masterlist->type == "P")
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">{{$masterlist["title"]}}</a>
                                                    </h4>
                                                </div>
                                                <div id="collapse1" class="panel-collapse collapse in">
                                                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                    </div>
                                                </div>
                                            </div>
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