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

                <h1>Editing Movie: {{ $movie->title }}</h1>

                <hr/>

                {{ Form::model($movie, array('url' => array('admin/update', $movie->id),
                        'method' => 'PUT')) }}
                    <div class="col-lg-12 form-group">
                        {!! Form::label('title', 'Title:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-3">
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
                                <option value="{{ $selectedCountry }}">{{ $selectedCountry }}</option>
                                @foreach($countries as $country)
                                    @if($country != $selectedCountry)
                                        <option value= "{{ $country }}">{{ $country }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('release_date', 'Release Date:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-2">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-calendar"></i>
                                {!! Form::text('release_date', $convertedDate, ['class' => 'form-control',
                                    'id' => 'datepicker']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('genre', 'Genre:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-5">
                            <select id="genre", name="genre", class="selectpicker", data-style="btn-info">
                                <option value="{{ $selectedGenre }}">{{ ucfirst($selectedGenre) }}</option>
                                @foreach($genres as $genre)
                                    @if($genre != $selectedGenre)
                                        <option value= "{{ $genre }}">{{ $genre }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('parental_rating', 'Rating:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-5">
                            <select id="parental_rating", name="parental_rating", class="selectpicker",
                                    data-style="btn-info">
                                <option value="{{ $selectedRating }}">{{ $selectedRating }}</option>
                                @foreach($ratings as $rating)
                                    @if($rating != $selectedRating)
                                        <option value= "{{ $rating }}">{{ $rating }}</option>
                                    @endif
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

                    <div class="col-lg-8 form-group">
                        {{ Form::submit('Update Movie', array('class' => 'btn btn-primary form-control')) }}
                    </div>
                {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection