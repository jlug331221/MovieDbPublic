<!-- Created by John on 3/5/16 -->

@extends('layouts.app')

@section('content')
    <div class="container">
        @include('errors.display')

        <h1>People Search</h1>
        <hr/>

        <div class="AdvSearch col-sm-9">

            {!! Form::open(['url' => '/search/person', 'class' => 'form-horizontal']) !!}

            <!-- Name -->
            <div class="AdvSearch__form-input">
                <label for="name">Name</label>
                <input type="text"
                       id="name"
                       class="form-control"
                       placeholder="Enter a name..."
                       value="{{ old('name', '') }}"
                       name="name">
                <div class="AdvSearch__description">
                    Enter the some or all of a name that you'd like to search for. E.g. Arnold
                </div>
            </div>


            <!-- Date of Birth -->
            <div class="AdvSearch__form-input">
                <label for="dob">Date of Birth</label>
                <div class="AdvSearch__to-from-row">
                    <div class="input-group date AdvSearch__to-from" id="AdvSearch__datepicker_from">
                        <input type="text"
                               class="form-control"
                               id="dob"
                               placeholder="Beginning on..."
                               value="{{ old('date-of-birth-start', '') }}"
                               name="date-of-birth-start"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    <h5>{{ 'to' }}</h5>
                    <div class="input-group date AdvSearch__to-from" id="AdvSearch__datepicker_to">
                        <input type="text"
                               class="form-control"
                               placeholder="Ending on..."
                               value="{{ old('date-of-birth-end', '') }}"
                               name="date-of-birth-end"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="AdvSearch__description">
                    Format: mm/dd/yyyy. Pick a span of time by entering both dates, such as 01/01/1945 to 01/01/1965 for
                    results containing born between 1945 and 1965. A single date may be entered, such as beginning on
                    12/25/1981 for results appearing after Dec 25, 1981, or ending on 10-31-1995 for results appearing
                    before Oct 31, 1995.
                </div>
            </div>

            <!-- Date of Death -->
            <div class="AdvSearch__form-input">
                <label for="dob">Date of Death</label>
                <div class="AdvSearch__to-from-row">
                    <div class="input-group date AdvSearch__to-from" id="AdvSearch__datepicker_from2">
                        <input type="text"
                               class="form-control"
                               id="dod"
                               placeholder="Beginning on..."
                               value="{{ old('date-of-death-start', '') }}"
                               name="date-of-death-start"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    <h5>{{ 'to' }}</h5>
                    <div class="input-group date AdvSearch__to-from" id="AdvSearch__datepicker_to2">
                        <input type="text"
                               class="form-control"
                               placeholder="Ending on..."
                               value="{{ old('date-of-death-end', '') }}"
                               name="date-of-death-end"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="AdvSearch__description">
                    Format: mm/dd/yyyy.
                </div>
            </div>

            <!-- Countries -->
            <div class="AdvSearch__form-input">
                <label for="countries">Countries of Origin</label>
                <select multiple
                        id="countries"
                        class="form-control"
                        name="countries[]">
                    @foreach ($countries as $country)
                        <option @if (old('countries') && in_array($country, old('countries'))) selected @endif>
                            {{ $country }}
                        </option>
                    @endforeach
                </select>
                <div class="AdvSearch__description">
                    Limit the results by selecting countries of origin. For instance, select Spain and Portugal to see only people born in one of those two countries.
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
                    Enter a list of keywords separated by commas to search for people. E.g. Comedian, filmmaker, monologues, ...
                </div>
            </div>
            <hr/>

            <!-- Submit -->
            <input class="btn btn-primary btn-block" type="submit" value="Submit">

            {!! Form::close() !!}

        </div>
    </div>
@endsection