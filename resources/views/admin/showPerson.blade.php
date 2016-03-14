@extends('layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1>Showing {{ $person->first_name }}</h1>
            </div>
        </div>
    </div>
@endsection