@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Create A Discussion
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ url('discussions/submit/'.$movie_id ) }}" method="POST" role="form">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="col-md-1 control-label">
                                    Title:
                                </label>
                                <div class="col-md-11 ">
                                    <input class="form-control" type="text" value="" name="title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-1 control-label">
                                    Body:
                                </label>
                                <div class="col-md-11">
                                    <textarea class="form-control" rows="12" value="" name="body"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-1 col-md-offset-1">
                                    <button class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection