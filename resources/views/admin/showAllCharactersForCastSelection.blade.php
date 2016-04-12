@extends('layouts.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1>Select Character for: <strong>{{ $person->first_name }}
                    {{ $person->last_name }}</strong>
                </h1>
                <h1>in <strong>{{ $movie->title }}</strong></h1>

                <hr/>

                <div class="container-fluid">
                    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead class="table-invert">
                        <tr>
                            <th style="text-align: center;"><h4>Character Name</h4></th>
                            <th style="text-align: center;"><h4>Make Selection</h4></th>
                        </tr>
                        </thead>
                        <tfoot class="table-invert">
                        <tr>
                            <td style="text-align: center;"><h4>Character Name</h4></td>
                            <td style="text-align: center;"><h4>Make Selection</h4></td>
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
                                <td align="center">
                                    <a href="{{ url('/admin/addCastMember/'.
                                                $person->id). '&' . $movie->id . '&' .
                                                $character->id }}">
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