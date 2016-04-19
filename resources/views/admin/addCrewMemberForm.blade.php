@extends('layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1>Add Crew Member Form for: <strong>{{ $movie->title }}</strong></h1>

                <hr/>

                <h3>Select a Crew Member Role for:
                    @if($person->first_alias != null)
                        <strong> {{ $person->first_alias }} {{ $person->last_name }}</strong>
                    @else
                        <strong>{{ $person->first_name }} {{ $person->last_name }}</strong>
                    @endif
                </h3>

                <br />

                {!! Form::open() !!}
                    <div class="col-lg-12 form-group">
                        {!! Form::label('credit_type_id', 'Crew Member Role:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-lg-5">
                            <select id="credit_type_id", name="credit_type_id", class="selectpicker", data-style="btn-info">
                                @foreach($credit_types as $credit_type)
                                    @if($credit_type->type != 'Cast')
                                    <option value= "{{ $credit_type->type }}">{{ $credit_type->type }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('remark', 'Role Description:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-sm-6">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-film"></i>
                                {!! Form::text('remark', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-lg-8 form-group">
                        {{ Form::submit('Add Crew for Member ' . $movie->title, array('class' => 'btn btn-primary form-control')) }}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection