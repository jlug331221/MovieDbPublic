@extends('layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1>Add Crew Member Form for: <strong>{{ $movie->title }}</strong></h1>

                <hr/>

                <!-- I am not done with the page yet. Do not judge me! -->

                {!! Form::open() !!}
                    <div class="col-lg-12 form-group">
                        {!! Form::label('crew_member', 'Cast Member:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-3">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-odnoklassniki"></i>
                                {!! Form::text('crew_member',
                                    $person->first_name . ' ' . $person->last_name,
                                        ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection