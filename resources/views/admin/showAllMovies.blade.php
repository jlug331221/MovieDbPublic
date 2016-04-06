@extends('layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1>All Movies</h1>

                <hr/>

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            &times;
                        </button>
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if (Session::has('message'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            &times;
                        </button>
                        {{ Session::get('message') }}
                    </div>
                @endif

                <div class="container-fluid">
                    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead class="table-invert">
                            <tr>
                                <th><h4>Title</h4></th>
                                <th><h4>Country</h4></th>
                                <th><h4>Release Date</h4></th>
                                <th><h4>Genre</h4></th>
                                <th><h4>Rating</h4></th>
                                <th><h4>Runtime</h4></th>
                                <th><h4>Administration</h4></th>
                            </tr>
                        </thead>
                        <tfoot class="table-invert">
                            <tr>
                                <td><h4>Title</h4></td>
                                <td><h4>Country</h4></td>
                                <td><h4>Release Date</h4></td>
                                <td><h4>Genre</h4></td>
                                <td><h4>Rating</h4></td>
                                <td><h4>Runtime</h4></td>
                                <td><h4>Administration</h4></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($movies as $movie)
                                <tr>
                                    <td>
                                        <a href="{{ url('admin/showMovie/'. $movie->id) }}">
                                            <h5>{{ $movie->title }}</h5>
                                        </a>
                                    </td>
                                    <td><h5>{{ $movie->country }}</h5></td>
                                    <td><h5>{{ $movie->release_date }}</h5></td>
                                    <td><h5>{{ $movie->genre }}</h5></td>
                                    <td><h5>{{ $movie->parental_rating }}</h5></td>
                                    <td><h5>{{ $movie->runtime }}</h5></td>
                                    <td align="center">
                                        <a href="{{ url('admin/showMovie/'. $movie->id) }}">
                                            <i class="fa fa-pencil-square-o fa-lg"></i>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a href="{{ url('admin/deleteMovie/'. $movie->id) }}">
                                            <i class="fa fa-trash fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endSection