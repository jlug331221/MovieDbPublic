@extends('layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Welcome {{ Auth::user()->name }}</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
@endsection