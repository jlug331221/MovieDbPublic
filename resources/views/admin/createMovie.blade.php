@extends('layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1>Create Movie Form</h1>

                <hr/>

                @if($errors->has())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{ $error }}<br/>
                        @endforeach
                    </div>
                @endif

                {!! Form::open() !!}
                    <div class="col-lg-12 form-group">
                        {!! Form::label('title', 'Title:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-2">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-film"></i>
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('country', 'Country:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-5">
                            <select id="country", name="country", class="selectpicker", data-style="btn-info">
                                @foreach($countries as $country)
                                    <option value= "{{ $country }}">{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('release_date', 'Date:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-2">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-calendar"></i>
                                {!! Form::text('release_date', null, ['class' => 'form-control',
                                'placeholder' => 'mm/dd/yyyy','id' => 'datepicker']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('genre', 'Genre:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-5">
                            <select id="genre", name="genre", class="selectpicker", data-style="btn-info">
                                @foreach($genres as $genre)
                                    <option value= "{{ $genre }}">{{ $genre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('parental_rating', 'Rating:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-5">
                            <select id="parental_rating", name="parental_rating", class="selectpicker",
                                    data-style="btn-info">
                                @foreach($ratings as $rating)
                                    <option value= "{{ $rating }}">{{ $rating }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('runtime', 'Runtime:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-2">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-clock-o"></i>
                                {!! Form::text('runtime', null, ['class' => 'form-control',
                                'placeholder' => 'Minutes']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('synopsis', 'Synopsis:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-5">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-pencil"></i>
                                {!! Form::textarea('synopsis', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <hr/>

                    <div class="col-lg-8 form-group">
                        {!! Form::submit('Create Movie', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection