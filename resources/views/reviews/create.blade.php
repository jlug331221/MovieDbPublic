<!-- Chris created file on $(DATE) -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Create A Review
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ url('reviews/submit/'.$movie_id ) }}" method="POST" role="form">
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
                                    Rating:
                                </label>
                                <div class="col-md-11">
                                    <select class="form-control" name="rating">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-1 control-label">
                                    Review:
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