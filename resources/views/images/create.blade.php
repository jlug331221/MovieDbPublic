@extends('layout.app')

@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops! </strong> There were some problems with your input. <br> <br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }} </li>
                @endforeach

            </ul>
        </div>
    @endif

    <div class="container">
        <h1>Upload Image</h1>
        <hr/>

        {!! Form::open(['url' => '/images/store', 'files' => true, 'class' => 'form']) !!}

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
@endsection