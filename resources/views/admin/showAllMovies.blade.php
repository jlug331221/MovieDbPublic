@extends('layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1>All Movies</h1>

                <hr/>

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
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($movies as $movie)
                                <tr>
                                    <td><h5>{{ $movie->title }}</h5></td>
                                    <td><h5>{{ $movie->country }}</h5></td>
                                    <td><h5>{{ $movie->release_date }}</h5></td>
                                    <td><h5>{{ $movie->genre }}</h5></td>
                                    <td><h5>{{ $movie->parental_rating }}</h5></td>
                                    <td><h5>{{ $movie->runtime }}</h5></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endSection