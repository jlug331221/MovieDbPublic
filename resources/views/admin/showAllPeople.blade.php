@extends('layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1>All People</h1>

                <hr/>

                @foreach($people as $person)
                    <h2>{{ $person->first_name }}</h2>
                @endforeach

            </div>
        </div>
    </div>
@endSection