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
                        <div class="col-lg-5">
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('country', 'Country:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-5">
                            {!! Form::select('country', $countries, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('release_date', 'Date:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-5">
                            {!! Form::text('release_date', null, ['class' => 'form-control',
                                'placeholder' => 'mm/dd/yyyy','id' => 'datepicker']) !!}
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('genre', 'Genre:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-5">
                            {!! Form::select('genre', $genres, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('parental_rating', 'Rating:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-5">
                            {!! Form::select('parental_rating', ['R'=> 'R', 'PG-13' => 'PG-13',
                                'PG' => 'PG', 'G'=> 'G', 'NC-17' => 'NC-17'],
                                ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('runtime', 'Runtime:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-5">
                            {!! Form::text('runtime', null, ['class' => 'form-control',
                                'placeholder' => 'Minutes']) !!}
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('synopsis', 'Synopsis:', ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-5">
                            {!! Form::textarea('synopsis', null, ['class' => 'form-control']) !!}
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