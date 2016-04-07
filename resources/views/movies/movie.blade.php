<!-- Ashley created file on $(DATE) -->

@extends('layouts.app')

@section('content')

    <div class="container">

        <!-- Movie Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> {{ $movie->title }}
                    <small> ({{ $year }}) </small>
                    @can('edit_all_content')
                        <a href="#"><button type="button" class="btn MoviePage__btnAdmin">Edit Movie</button></a>
                        <a href="#"><button type="button" class="btn MoviePage__btnAdmin">Delete Movie</button></a>
                    @endcan
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Top Movie Page Row -->
        <div class="row MoviePage__Top">

            <div class="col-md-4 MoviePage__Image">
                <img class="img-responsive MoviePage__poster" src="http://www.cinemasterpieces.com/term1.jpg" width="300px" height="500px" alt="">

                @if(Auth::check())
                    <button type="button" class="btn MoviePage__btnImage">Add to List</button> <br>
                @endif

            </div>  <!-- 260 * 420 -->

            <div class="col-md-8 MoviePage__Desc">
                <h3>Synopsis</h3>
                <p>
                    {{$movie->synopsis}}
                </p>
                <h3>Movie Details</h3>
                <ul class="list-group MoviePage__listGroup">
                    <li class="list-group-item MoviePage__listGroupItem">Director:<span class="MoviePage__directorText">{{$director->first_name}} {{$director->last_name}}</span></li>
                    <li class="list-group-item MoviePage__listGroupItem">Country:<span class="MoviePage__countryText">{{$movie->country}}</span></li>
                    <li class="list-group-item MoviePage__listGroupItem">Genre:<span class="MoviePage__genreText">{{$movie->genre}}</span></li>
                    <li class="list-group-item MoviePage__listGroupItem">Parental Rating:<span class="MoviePage__ratingText">{{$movie->parental_rating}}</span></li>
                    <li class="list-group-item MoviePage__listGroupItem">Release Date:<span class="MoviePage__releaseText">{{$newDate}}</span></li>
                    <li class="list-group-item MoviePage__listGroupItem">Length:<span class="MoviePage__lengthText">{{$movie->runtime}} minutes</span></li>
                </ul>
            </div>

        </div>
        <!-- /.row -->

        <!-- Second Row -->
        <div class="row MoviePage__Second">
            <div class="col-lg-12">
                <h3 class="page-header">Pictures</h3>
            </div>

            <div class="col-md-6">
                <p>This section is reserved for a horizontal view of movie pictures.</p>
            </div>
        </div>
        <!-- /.row -->

        <!-- Third Row -->
        <div class="row MoviePage__Third">

            <div class="col-lg-12">
                <h3 class="page-header">The Cast
                <small class="MoviePage__tableInfo">(Click to expand/collapse)</small>
                </h3>
            </div>

            <div class="col-md-12 MoviePage__cast">

                <table class="table table-responsive table-hover">
                    <thead>
                    <tr>
                        <th style="text-align: center">Picture</th>
                        <th style="text-align: left">Name</th><th></th>
                        <th style="text-align: left">Role</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="clickable" data-toggle="collapse" id="row1" data-target=".row1">
                        <td align ="center">
                            @if($firstPersonCast->default === null)
                                <img src="http://popwrapped.com/wp-content/uploads/2015/07/o-ARNOLD-SCHWARZENEGGER-ILL-BE-BACK-facebook.jpg"
                                     class="img-responsive center-block"
                                     style="height:85px;">
                            @else
                                <img src="{{ url($firstPersonCast->path . '/thumbs/'
                                        . $firstPersonCast->name . '.'
                                        . $firstPersonCast->extension)}}"
                                     class="img-responsive center-block"
                                     style="height: 85px;">
                            @endif
                        </td>
                        <td>{{$firstPersonCast->first_name}} {{$firstPersonCast->last_name}}</td>
                        <td align="left">...</td>
                        <td align="left">
                            {{$firstPersonRole->name}}
                        </td>
                    </tr>
                    @foreach($newCastCollection as $cast)
                        <tr class="collapse row1">
                            <td align ="center">
                                @if($cast->default === null)
                                    <img src="http://popwrapped.com/wp-content/uploads/2015/07/o-ARNOLD-SCHWARZENEGGER-ILL-BE-BACK-facebook.jpg"
                                         class="img-responsive center-block"
                                         style="height:85px;">
                                @else
                                    <img src="{{ url($cast->path . '/thumbs/'
                                        . $cast->name . '.'
                                        . $cast->extension)}}"
                                         class="img-responsive center-block"
                                         style="height: 85px;">
                                @endif
                            </td>
                            <td>{{$cast->first_name}} {{$cast->last_name}}</td>
                            <td align="left">...</td>
                            <td align="left">
                                {{$cast->name}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->

        <!-- Fourth row -->
        <div class="row MoviePage__Fourth">

            <div class="col-lg-12">
                <h3 class="page-header">The Crew
                    <small class="MoviePage__tableInfo">(Click to expand/collapse)</small>
                </h3>
            </div>

            <div class="col-md-12 MoviePage__crew">
                <table class="table table-responsive table-hover">
                    <thead>
                    <tr>
                        <th style="text-align: center">Picture</th>
                        <th style="text-align: left">Name</th><th></th>
                        <th style="text-align: left">Title</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="clickable" data-toggle="collapse" id="row1A" data-target=".row1A">
                        <td align ="left">
                            @if($firstPersonCrew->default === null)
                                <img src="http://popwrapped.com/wp-content/uploads/2015/07/o-ARNOLD-SCHWARZENEGGER-ILL-BE-BACK-facebook.jpg"
                                     class="img-responsive center-block"
                                     style="height:85px;">
                            @else
                                <img src="{{ url($firstPersonCrew->path . '/thumbs/'
                                        . $firstPersonCrew->name . '.'
                                        . $firstPersonCrew->extension)}}"
                                     class="img-responsive center-block"
                                     style="height: 85px;">
                            @endif
                        </td>
                        <td>{{$firstPersonCrew->first_name}} {{$firstPersonCrew->last_name}}</td>
                        <td align="left">...</td>
                        <td align="left">
                            @if($firstPersonCrew->type === 'Crew')
                                {{$firstPersonCrew->remark}}
                            @else
                                {{$firstPersonCrew->type}}
                            @endif
                        </td>
                    </tr>
                    @foreach($newCrewCollection as $crew)
                        <tr class="collapse row1A">
                            <td align ="center">
                                @if($crew->default === null)
                                    <img src="http://popwrapped.com/wp-content/uploads/2015/07/o-ARNOLD-SCHWARZENEGGER-ILL-BE-BACK-facebook.jpg"
                                         class="img-responsive center-block"
                                         style="height:85px;">
                                @else
                                    <img src="{{ url($crew->path . '/thumbs/'
                                        . $crew->name . '.'
                                        . $crew->extension)}}"
                                        class="img-responsive center-block"
                                        style="height: 85px;">
                                @endif
                            </td>
                            <td>{{$crew->first_name}} {{$crew->last_name}}</td>
                            <td align="left">...</td>
                            <td align="left">
                                @if($crew->type === 'Crew')
                                    {{$crew->remark}}
                                @else
                                    {{$crew->type}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->

        <!-- Fifth Row -->
        <div class="row MoviePage__Fifth">

            <div class="col-lg-12">
                <h3 class="page-header">Reviews</h3>
            </div>

            <div class="col-md-6">
                <p>I am reserving this section for reviews.</p>
            </div>
        </div>
        <!-- /.row -->

        <!-- Sixth Row -->
        <div class="row MoviePage__Sixth">

            <div class="col-lg-12">
                <h3 class="page-header">Discussions</h3>
            </div>

            <div class="col-md-6">
                <p>This section is potentially for movie discussions.</p>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection