<!-- Chris created file on $(DATE) -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Enter New Comment
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ url('reviews/postcomment/'.$review_id ) }}" method="POST" role="form">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea class="form-control" rows="12" value="" name="body"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-1">
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