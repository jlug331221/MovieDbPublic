@extends('layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1>Create Person Form</h1>

                <hr/>

                @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{ $error }}<br/>
                        @endforeach
                    </div>
                @endif

                {!! Form::open() !!}
                    <div class="col-lg-12 form-group">
                        {!! Form::label('first_name', 'First Name:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-3">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-odnoklassniki"></i>
                                {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('middle_name', 'Middle Name:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-3">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-odnoklassniki"></i>
                                {!! Form::text('middle_name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('last_name', 'Last Name:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-3">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-odnoklassniki"></i>
                                {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('first_alias', 'First Alias:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-3">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-odnoklassniki"></i>
                                {!! Form::text('first_alias', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('middle_alias', 'Middle Alias:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-3">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-odnoklassniki"></i>
                                {!! Form::text('middle_alias', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('last_alias', 'Last Alias:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-3">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-odnoklassniki"></i>
                                {!! Form::text('last_alias', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('country_of_origin', 'Country of Birth:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-5">
                            <select id="country_of_origin", name="country_of_origin", class="selectpicker", data-style="btn-info">
                                @foreach($countries as $country)
                                    <option value= "{{ $country }}">{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('date_of_birth', 'Date of Birth:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-2">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-calendar"></i>
                                {!! Form::text('date_of_birth', null, ['class' => 'form-control',
                                'placeholder' => 'mm/dd/yyyy','id' => 'datepicker']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('date_of_death', 'Date of Death:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-2">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-calendar"></i>
                                {!! Form::text('date_of_death', null, ['class' => 'form-control',
                                'placeholder' => 'mm/dd/yyyy','id' => 'datepicker2']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('biography', 'Biography:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-5">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-pencil"></i>
                                {!! Form::textarea('biography', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <hr/>

                    <div class="col-lg-8 form-group">
                        {!! Form::submit('Create Person', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection