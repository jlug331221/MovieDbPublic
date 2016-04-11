<!-- Created by John on 3/5/16 -->

@extends('layouts.app')

@section('content')

    <div class="container">
        @include('errors.display')

        <h1>Movie Search</h1>
        <hr/>

        <div class="AdvSearch col-sm-9">

            {!! Form::open(['url' => '/search/movie', 'class' => 'form-horizontal']) !!}

            <!-- Name -->
            <div class="AdvSearch__form-input">
                <label for="name">Name</label>
                <input type="text"
                       id="name"
                       class="form-control"
                       placeholder="Enter a movie name..."
                       value="{{ old('name', '') }}"
                       name="name">
                <div class="AdvSearch__description">
                    Enter the full or partial name of a movie that you'd like to search for. E.g. Dr. Strangelove
                </div>
            </div>

            <!-- Genres -->
            <div class="AdvSearch__form-input">
                <label for="genre">Genres</label>
                <div class="AdvSearch__card">
                    <div class="AdvSearch__grid">
                        @foreach ($genres as $genre)
                            <div class="AdvSearch__genre">
                                <input type="checkbox"
                                       name="genre[]"
                                       @if (old('genre') && in_array($genre, old('genre'))) checked @endif
                                       value="{{ $genre }}"/>
                                {{ $genre }}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="AdvSearch__description">
                    Limit the results to a group of genres. For instance, select Action, Horror, and Western to see
                    movies fitting at least one of those genres.
                </div>
            </div>

            <!-- Date -->
            <div class="AdvSearch__form-input">
                <label for="release">Release Date</label>
                <div class="AdvSearch__to-from-row">
                    <div class="input-group date AdvSearch__to-from" id="AdvSearch__datepicker_from">
                        <input type="text"
                               class="form-control"
                               id="release"
                               placeholder="Beginning on..."
                               value="{{ old('date-start', '') }}"
                               name="date-start"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    <h5>{{ 'to' }}</h5>
                    <div class="input-group date AdvSearch__to-from" id="AdvSearch__datepicker_to">
                        <input type="text"
                               class="form-control"
                               placeholder="Ending on..."
                               value="{{ old('date-end', '') }}"
                               name="date-end"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="AdvSearch__description">
                    Format: mm/dd/yyyy. Pick a span of time by entering both dates, such as 01/01/1992 to 01/01/2002 for
                    results containing movies from 1992 to 2002. A single date may be entered, such as beginning on
                    05/01/1970 for results appearing after May 01, 1970, or ending on 08/13/1984 for results appearing
                    before August 13, 1984.
                </div>
            </div>

            <!-- Countries -->
            <div class="AdvSearch__form-input">
                <label for="countries">Countries</label>
                <select multiple
                        id="countries"
                        class="form-control"
                        name="countries[]">
                    @foreach ($countries as $country)
                        <option
                            @if (old('countries') && in_array($country, old('countries')))
                                selected
                            @endif>{{ $country }}</option>
                    @endforeach
                </select>
                <div class="AdvSearch__description">
                    Limit the results by selecting countries of origin. For instance, select United States and Brazil to
                    see only movies from those countries.
                </div>
            </div>

            <!-- Parental Ratings -->
            <div class="AdvSearch__form-input">
                <label for="rating">Parental Rating</label>
                <div class="AdvSearch__card">
                    <div class="AdvSearch__grid AdvSearch--justify-grid">
                        @foreach ($ratings as $rating => $rating_val)
                            <div class="AdvSearch__rating">
                                <input type="checkbox"
                                       name="rating[]"
                                       @if (old('rating') && in_array($rating, old('rating'))) checked @endif
                                       value="{{ $rating }}"/>
                                <img src="{{ $rating_val }}"/>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="AdvSearch__description">
                    Limit the results to a group of parental ratings. For instance, selecting G and PG limits movie
                    results to only those ratings.
                </div>
            </div>

            <!-- Run Time -->
            <div class="AdvSearch__form-input">
                <label for="runtime">Run Time</label>
                <div class="AdvSearch__to-from-row">
                    <div class="input-group AdvSearch__to-from">
                        <input type="text"
                               class="form-control"
                               placeholder="Minimum..."
                               value="{{ old('runtime-min', '') }}"
                               name="runtime-min"/>
                        <span class="input-group-addon">mins</span>
                    </div>
                    <h5>{{ 'to' }}</h5>
                    <div class="input-group AdvSearch__to-from">
                        <input type="text"
                               class="form-control"
                               placeholder="Maximum..."
                               value="{{ old('runtime-max', '') }}"
                               name="runtime-max"/>
                        <span class="input-group-addon">mins</span>
                    </div>
                </div>
                <div class="AdvSearch__description">
                    Pick a span of time by entering a minimum and maximum runtime, such as 90 to 120 for results with
                    run times between 90 and 120 minutes (inclusive). Choosing just the minimum or maximum will set an
                    upper or lower bound on the runtime, such as a minimum of 84 for results that have run times greater
                    than or equal to 84 minutes.
                </div>
            </div>

            <!-- Keyword -->
            <div class="AdvSearch__form-input">
                <label for="keyword">Keyword Search</label>
                <textarea class="form-control"
                          id="keyword"
                          placeholder="Enter keywords..."
                          value="{{ old('keyword', '') }}"
                          name="keyword"
                          rows="2"></textarea>
                <div class="AdvSearch__description">
                    Enter a list of keywords separated by commas to search for movies. E.g. New York, Annie, love, ...
                </div>
            </div>

            <hr/>

            <!-- Submit -->
            <input class="btn btn-primary btn-block" type="submit" value="Submit">

            {!! Form::close() !!}

        </div>
    </div>

@endsection