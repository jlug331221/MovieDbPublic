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

                <h1>Editing Movie: {{ $movie->title }}
                    <a href="{{ url('admin/deleteMovie/'. $movie->id) }}">
                        <i class="fa fa-trash"></i>
                    </a>
                </h1>

                <hr/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-6">
                {{ Form::model($movie, array('url' => array('admin/updateMovie', $movie->id),
                        'method' => 'PUT')) }}
                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('title', 'Title:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-sm-6">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-film"></i>
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('country', 'Country:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-md-5 col-lg-5">
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

                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('release_date', 'Release Date:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-sm-4">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-calendar"></i>
                                {!! Form::text('release_date', $convertedDate, ['class' => 'form-control',
                                    'id' => 'datepicker']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('genre', 'Genre:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-md-5 col-lg-5">
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

                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('parental_rating', 'Rating:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-md-5 col-lg-5">
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

                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('runtime', 'Runtime:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-sm-3">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-clock-o"></i>
                                {!! Form::text('runtime', null, ['class' => 'form-control',
                                'placeholder' => 'Minutes']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 form-group">
                        {!! Form::label('synopsis', 'Synopsis:', ['class' => 'col-md-2 col-lg-2 control-label']) !!}
                        <div class="col-md-10 col-lg-10">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-pencil"></i>
                                {!! Form::textarea('synopsis', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 form-group">
                        {{ Form::submit('Update Movie', array('class' => 'btn btn-primary form-control')) }}
                    </div>
                {{ Form::close() }}
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="col-md-8 col-lg-8">
                    @if($movieAlbum->first() === null)
                        {!! Html::image('http://masterherald.com/wp-content/uploads/2015/01/arnold-schwarzenegger.jpg',
                        'arnold_image', array('width' => '100%', 'height' => 'auto')) !!} <br/>
                        <h3>Arnold is wondering why this movie has no images</h3>
                    @else
                        <img src="{{ url($movieAlbum->first()->getPath()) }}" class="img-responsive"
                             style="width: 100%; height: auto;">
                    @endif
                </div>
            </div>
        </div>

        <hr/>

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

                <h3>Movie Images:</h3>
                @foreach($movieAlbum as $i)
                    <div class="col-md-2">
                        <img src="{{ url($i->getPath()) }}" class="img-responsive"
                             style="height: 250px;">
                        <a href="{{ url('/images/destroyMovieImage/movie/'
                            . $movie->id . '/image/' . $i->id) }}">
                            <i class="fa fa-trash fa-2x" style="margin-top: 10px;"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                @if (Session::has('removeCastCrewMessage'))
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            &times;
                        </button>
                        {{ Session::get('removeCastCrewMessage') }}
                    </div>
                @endif

                    @if (Session::has('success'))
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                &times;
                            </button>
                            {{ Session::get('success') }}
                        </div>
                    @endif

                <div class="col-md-6 col-lg-6">
                    <h2>Cast |
                        <a href="{{ url('/admin/showAllPeopleForCastSelection/' . $movie->id) }}">
                            <i class="fa fa-plus-square-o fa-lg"></i>
                        </a>
                    </h2>
                    <hr/>
                    <table class="table table-responsive table-striped
                                table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Image</th>
                                <th style="text-align: center;">Name</th>
                                <th style="text-align: center;">Character</th>
                                <th style="text-align: center;">Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cast as $c)
                                <tr class="info">
                                    <td>
                                        @if($c->default === null)
                                            <img src="http://masterherald.com/wp-content/uploads/2015/01/arnold-schwarzenegger.jpg"
                                                 class="img-responsive center-block"
                                                 style="height: 85px;">
                                        @else
                                            <img src="{{ url($c->path . '/thumbs/'
                                                . $c->name . '.'
                                                . $c->extension) }}"
                                                 class="img-responsive center-block"
                                                 style="height: 85px;">
                                        @endif
                                    </td>

                                    <td align="center">
                                        <a href="{{ url('/admin/showPerson/' . $c->person_id) }}">
                                            {{ $c->first_name }} {{ $c->last_name }}
                                        </a>
                                    </td>

                                    <td align="center">
                                        {{ $c->character_name }}
                                    </td>

                                    <td align="center">
                                        <a href="{{ url('/admin/removeCastCrew/' . $c->person_id
                                            . '/' . $c->movie_id . '/' . $c->credit_type_id) }}">
                                            <i class="fa fa-trash fa-lg" style="margin-top: 10px;"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6 col-lg-6">
                    <h2>Crew |
                        <a href="#">
                            <i class="fa fa-plus-square-o fa-lg"></i>
                        </a>
                    </h2>
                    <hr/>
                    <table class="table table-responsive table-striped
                                table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Image</th>
                                <th style="text-align: center;">Name</th>
                                <th style="text-align: center;">Role</th>
                                <th style="text-align: center;">Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($crew as $c)
                                <tr class="info">
                                    <td>
                                        @if($c->default === null)
                                            <img src="http://masterherald.com/wp-content/uploads/2015/01/arnold-schwarzenegger.jpg"
                                                 class="img-responsive center-block"
                                                 style="height: 85px;">
                                        @else
                                            <img src="{{ url($c->path . '/thumbs/'
                                                . $c->name . '.'
                                                . $c->extension) }}"
                                                 class="img-responsive center-block"
                                                 style="height: 85px;">
                                        @endif
                                    </td>

                                    <td align="center">
                                        <a href="{{ url('/admin/showPerson/' . $c->person_id) }}">
                                            {{ $c->first_name }} {{ $c->last_name }}
                                        </a>
                                    </td>

                                    <td align="center">{{ $c->type }}</td>

                                    <td align="center">
                                        <a href="{{ url('/admin/removeCastCrew/' . $c->person_id
                                            . '/' . $c->movie_id . '/' . $c->credit_type_id) }}">
                                            <i class="fa fa-trash fa-lg" style="margin-top: 10px;"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

                    <h1>Upload Movie Images:</h1>
                    {!! Form::open(['url' => '/images/storeMovieImage/' . $movie->id,
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
    </div>
@endsection