@extends('layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h1>Add a new cast member for: <strong>{{ $movie->title }}</strong></h1>

                <hr/>

                <div class="container-fluid">
                    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead class="table-invert">
                        <tr>
                            <th style="text-align: center;"><h4>First Name</h4></th>
                            <th style="text-align: center;"><h4>Last Name</h4></th>
                            <th style="text-align: center;"><h4>First Alias</h4></th>
                            <th style="text-align: center;"><h4>Make Selection</h4></th>
                        </tr>
                        </thead>
                        <tfoot class="table-invert">
                        <tr>
                            <td style="text-align: center;"><h4>First Name</h4></td>
                            <td style="text-align: center;"><h4>Last Name</h4></td>
                            <td style="text-align: center;"><h4>First Alias</h4></td>
                            <td style="text-align: center;"><h4>Make Selection</h4></td>
                        </tr>
                        </tfoot>
                        <tbody>
                            @foreach($people as $person)
                                <tr>
                                    <td>
                                        <a href="{{ url('admin/showPerson/'. $person->id) }}">
                                            <h5>{{ $person->first_name }}</h5>
                                        </a>
                                    </td>
                                    <td><h5>{{ $person->last_name }}</h5></td>
                                    <td><h5>{{ $person->first_alias }}</h5></td>
                                    <td align="center">
                                        <a href="{{ url('/admin/showAllCharactersForCastSelection/'.
                                                $person->id). '&' . $movie->id }}">
                                            <i class="fa fa-check-square-o fa-lg"></i>
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
@endsection