@extends('layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <br/>
                @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{ $error }}<br/>
                        @endforeach
                    </div>
                @endif

                <h1>Editing Character: {{ $character->character_name }}
                    <a href="{{ url('admin/deleteCharacter/'. $character->id) }}">
                        <i class="fa fa-trash"></i>
                    </a>
                </h1>

                <hr/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-6">
                {{ Form::model($character, array('url' => array('admin/updateCharacter', $character->id),
                        'method' => 'PUT')) }}
                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('character_name', 'Character Name:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-sm-6">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-odnoklassniki"></i>
                                {!! Form::text('character_name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('biography', 'Character Biography:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-md-10 col-lg-10">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-pencil"></i>
                                {!! Form::text('biography', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 form-group">
                        {{ Form::submit('Update Character', array('class' => 'btn btn-primary form-control')) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection