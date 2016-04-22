@extends('layouts.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h1>Create a Character</h1>

                <hr/>

                @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            &times;
                        </button>
                        @foreach($errors->all() as $error)
                            {{ $error }}<br/>
                        @endforeach
                    </div>
                @endif

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            &times;
                        </button>
                        {{ Session::get('success') }}
                    </div>
                @endif

                {!! Form::open() !!}
                    <div class="col-lg-12 form-group">
                        {!! Form::label('character_name', 'Character Name:',
                            ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-3">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-user"></i>
                                {!! Form::text('character_name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        {!! Form::label('biography', 'Character Biography:',
                            ['class' => 'col-lg-1 control-label']) !!}
                        <div class="col-lg-5">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-pencil"></i>
                                {!! Form::textarea('biography', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12"><hr /></divclass>

                    <div class="col-lg-8 form-group">
                        {!! Form::submit('Create Character', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection