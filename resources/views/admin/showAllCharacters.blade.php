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

                <div class="container-fluid">
                    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead class="table-invert">
                        <tr>
                            <th style="text-align: center;"><h4>Character Name</h4></th>
                            <th style="text-align: center;"><h4>Character Bio</h4></th>
                            <th style="text-align: center;"><h4>Administration</h4></th>
                        </tr>
                        </thead>
                        <tfoot class="table-invert">
                        <tr>
                            <td style="text-align: center;"><h4>Character Name</h4></td>
                            <td style="text-align: center;"><h4>Character Bio</h4></td>
                            <td style="text-align: center;"><h4>Administration</h4></td>
                        </tr>
                        </tfoot>
                        <tbody>
                            @foreach($characters as $character)
                                <tr>
                                    <td>
                                        <a href="{{ url('admin/showCharacter/'. $character->id) }}">
                                            <h5>{{ $character->character_name }}</h5>
                                        </a>
                                    </td>
                                    <td><h5>{{ $character->biography }}</h5></td>
                                    <td align="center">
                                        <a href="{{ url('admin/showCharacter/'. $character->id) }}">
                                            <i class="fa fa-pencil-square-o fa-lg"></i>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a href="{{ url('admin/deleteCharacter/'. $character->id) }}">
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

@endsection