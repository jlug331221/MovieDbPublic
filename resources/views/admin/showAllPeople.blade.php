@extends('layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1>All People</h1>

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
                                <th style="text-align: center;"><h4>First Name</h4></th>
                                <th style="text-align: center;"><h4>Last Name</h4></th>
                                <th style="text-align: center;"><h4>First Alias</h4></th>
                                <th style="text-align: center;"><h4>Country of Origin</h4></th>
                                <th style="text-align: center;"><h4>Date of Birth</h4></th>
                                <th style="text-align: center;"><h4>Date of Death</h4></th>
                                <th style="text-align: center;"><h4>Administration</h4></th>
                            </tr>
                        </thead>
                        <tfoot class="table-invert">
                            <tr>
                                <td style="text-align: center;"><h4>First Name</h4></td>
                                <td style="text-align: center;"><h4>Last Name</h4></td>
                                <td style="text-align: center;"><h4>First Alias</h4></td>
                                <td style="text-align: center;"><h4>Country of Origin</h4></td>
                                <td style="text-align: center;"><h4>Date of Birth</h4></td>
                                <td style="text-align: center;"><h4>Date of Death</h4></td>
                                <td style="text-align: center;"><h4>Administration</h4></td>
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
                                    <td><h5>{{ $person->country_of_origin }}</h5></td>
                                    <td><h5>{{ $person->date_of_birth }}</h5></td>
                                    <td><h5>{{ $person->date_of_death }}</h5></td>
                                    <td align="center">
                                        <a href="{{ url('admin/showPerson/'. $person->id) }}">
                                            <i class="fa fa-pencil-square-o fa-lg"></i>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a href="{{ url('admin/deletePerson/'. $person->id) }}">
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