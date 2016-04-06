@extends('layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">

                @if($errors->has())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{ $error }}<br/>
                        @endforeach
                    </div>
                @endif

                <h1>Editing Person:
                    {{ $person->first_name }}
                </h1>

                <hr/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-6">
                {{ Form::model($person, array('url' => array('admin/updatePerson', $person->id),
                        'method' => 'PUT')) }}
                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('first_name', 'First Name:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-sm-6">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-odnoklassniki"></i>
                                {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('middle_name', 'Middle Name:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-sm-6">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-odnoklassniki"></i>
                                {!! Form::text('middle_name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('last_name', 'Last Name:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-sm-6">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-odnoklassniki"></i>
                                {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('first_alias', 'First Alias:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-sm-6">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-odnoklassniki"></i>
                                {!! Form::text('first_alias', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('middle_alias', 'Middle Alias:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-sm-6">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-odnoklassniki"></i>
                                {!! Form::text('middle_alias', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('last_alias', 'Last Alias:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-sm-6">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-odnoklassniki"></i>
                                {!! Form::text('last_alias', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('country_of_origin', 'Country of Birth:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-md-5 col-lg-5">
                            <select id="country_of_origin", name="country_of_origin", class="selectpicker", data-style="btn-info">
                                <option value="{{ $selectedCountry }}">{{ $selectedCountry }}</option>
                                @foreach($countries as $country)
                                    @if($selectedCountry != $country)
                                        <option value= "{{ $country }}">{{ $country }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('date_of_birth', 'Date of Birth:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-sm-4">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-calendar"></i>
                                {!! Form::text('date_of_birth', $convertedDateOfBirth, ['class' => 'form-control',
                                'placeholder' => 'mm/dd/yyyy','id' => 'datepicker']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('date_of_death', 'Date of Death:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-sm-4">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-calendar"></i>
                                {!! Form::text('date_of_death', $convertedDateOfDeath, ['class' => 'form-control',
                                'placeholder' => 'mm/dd/yyyy','id' => 'datepicker2']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('biography', 'Biography:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-md-10 col-lg-10">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-pencil"></i>
                                {!! Form::textarea('biography', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::submit('Update Person', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                {!! Form::close() !!}
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="col-md-6 col-lg-6">
                    @if($personAlbum->first() === null)
                        {!! Html::image('http://masterherald.com/wp-content/uploads/2015/01/arnold-schwarzenegger.jpg',
                        'arnold_image', array('width' => '100%', 'height' => 'auto')) !!}
                    @else
                        <img src="{{ url($personAlbum->first()->getPath()) }}" class="img-responsive"
                            style="width: 350px; height: 550px;">
                    @endif
                </div>
            </div>

            <div class="col-md-12 col-lg-12"><hr/></div>

            <div class="row">
                <div class="col-md-12 col-lg-12">
                    @if (Session::has('message'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                &times;
                            </button>
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <h3>Person Images:</h3>
                    @foreach($personAlbum as $i)
                        <div class="col-md-2">
                            <img src="{{ url($i->getPath()) }}" class="img-responsive"
                                style="height: 250px;">
                            <a href="{{ url('/images/destroyPersonImage/person/'
                                . $person->id . '/image/' . $i->id) }}">
                                <i class="fa fa-trash fa-2x" style="margin-top: 10px;"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-12 col-lg-12"><hr/></div>

            <div class="col-md-12" style="margin-bottom: 40px;">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            &times;
                        </button>
                        {{ Session::get('success') }}
                    </div>
                @endif

                <h1>Upload Images</h1>
                {!! Form::open(['url' => '/images/storePersonImage/' . $person->id,
                    'files' => true, 'class' => 'form']) !!}
                    <div class="form-group">
                        {!! Form::label('image', 'Image') !!}
                        {!! Form::file('image', null, ['required', 'class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::text('description', null, ['class' => 'form-control']) !!}
                    </div>

                    <div clas="form-group">
                        {!! Form::submit('Upload', ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection