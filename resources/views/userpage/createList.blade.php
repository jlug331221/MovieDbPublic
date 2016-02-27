@extends('layouts.app')

@section('content')

    {!! Form::open() !!}
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New List!</div>
                        <div class="panel-body">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}




    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-10 col-md-offset-1">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Create New List!</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="input-group">--}}
                                {{--<span class="input-group-addon" id="basic-addon1">New List</span>--}}
                                {{--<input type="text" class="form-control" id="listTitle" placeholder="Enter List Title" aria-describedby="basic-addon1">--}}
                            {{--</div>--}}

                            {{--<br>--}}
                            {{--<br>--}}

                            {{--<div class="row">--}}
                                {{--<div class="col-lg-6">--}}
                                    {{--<div class="input-group">--}}
                                        {{--<span class="input-group-addon">--}}
                                            {{--<input type="Radio" name="list" id="personRad" aria-label="...">--}}
                                        {{--</span>--}}
                                        {{--<input type="text" class="form-control" placeholder="Person List" aria-label="...">--}}
                                    {{--</div><!-- /input-group -->--}}
                                {{--</div><!-- /.col-lg-6 -->--}}
                                {{--<div class="col-lg-6">--}}
                                    {{--<div class="input-group">--}}
                                        {{--<span class="input-group-addon">--}}
                                            {{--<input type="radio" name="list" id="movieRad" aria-label="...">--}}
                                        {{--</span>--}}
                                        {{--<input type="text" class="form-control" placeholder="Movie List" aria-label="...">--}}
                                    {{--</div><!-- /input-group -->--}}
                                {{--</div><!-- /.col-lg-6 -->--}}
                            {{--</div><!-- /.row -->--}}

                            {{--<br>--}}
                            {{--<br>--}}

                            {{--<input align="center" onclick="checkForListType(); checkForListTitle()" type="submit" class="btn btn-info" value="Submit Button">--}}

                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<script type="text/javascript">--}}

        {{--function checkForListType() {--}}
            {{--if (document.getElementById("personRad").checked == false &&--}}
                    {{--document.getElementById("movieRad").checked == false) {--}}
                {{--alert("You have not selected the list type!");--}}
            {{--}--}}
            {{--else {--}}
                {{--// DO NOTHING--}}
            {{--}--}}
        {{--}--}}
        {{--function checkForListTitle() {--}}
            {{--var text = document.getElementById("listTitle").valueOf()--}}
            {{--if ()--}}
            {{--{--}}
                {{--alert("The List Title is empty")--}}
            {{--}--}}
        {{--}--}}

    {{--</script>--}}

@endsection