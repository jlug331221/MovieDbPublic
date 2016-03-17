@extends('layouts.app')

@section('content')

    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ Auth::user()->name }}, Welcome To The Avatar Module!</div>

                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-2 col-centered Userpage__center">
                                <img src="{{asset($avatar)}}" class="img-circle Userpage__avatar" alt="Avatar">
                            </div>
                        </div>

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

                        <div class="container-fluid">
                            <h1>Upload Image To Be Set As Your Avatar!</h1>
                            <hr/>

                            {!! Form::open(['url' => '/userpage/avatar/store', 'files' => true, 'class' => 'form']) !!}

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
            </div>
        </div>
    </div>


@endsection