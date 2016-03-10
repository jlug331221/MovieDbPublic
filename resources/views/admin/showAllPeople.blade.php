@extends('layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1>All People</h1>

                <hr/>

                <div class="container-fluid">
                    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead class="table-invert">
                            <tr>
                                <th><h4>First Name</h4></th>
                                <th><h4>Last Name</h4></th>
                                <th><h4>First Alias</h4></th>
                                <th><h4>Country of Origin</h4></th>
                                <th><h4>Date of Birth</h4></th>
                                <th><h4>Date of Death</h4></th>
                            </tr>
                        </thead>
                        <tfoot class="table-invert">
                            <tr>
                                <td><h4>First Name</h4></td>
                                <td><h4>Last Name</h4></td>
                                <td><h4>First Alias</h4></td>
                                <td><h4>Country of Origin</h4></td>
                                <td><h4>Date of Birth</h4></td>
                                <td><h4>Date of Death</h4></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($people as $person)
                                <tr>
                                    <td><h5>{{ $person->first_name }}</h5></td>
                                    <td><h5>{{ $person->last_name }}</h5></td>
                                    <td><h5>{{ $person->first_alias }}</h5></td>
                                    <td><h5>{{ $person->country_of_origin }}</h5></td>
                                    <td><h5>{{ $person->date_of_birth }}</h5></td>
                                    <td><h5>{{ $person->date_of_death }}</h5></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endSection