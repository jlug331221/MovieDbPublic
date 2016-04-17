<!-- Ashley created file on $(DATE) -->

@extends('layouts.app')

@section('content')

    <div class="container">

        @if ($movie)
            <!-- Movie Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        @if($movie->title === null)
                            <p>We're sorry! There doesn't seem to be a title in our records.</p>
                        @else
                            {{ $movie->title }}
                        @endif

                        <small>
                        @if ($year)
                            ({{ $year }})
                        @endif
                        </small>

                        @can('edit_all_content')
                            <a href="{{ url('/admin/showMovie/' . $movie->id) }}"><button type="button" class="btn MoviePage__btnAdmin">Edit Movie</button></a>
                            <a href="{{ url('/admin/deleteMovie/' . $movie->id) }}"><button type="button" class="btn MoviePage__btnAdmin">Delete Movie</button></a>
                        @endcan
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <!-- Top Movie Page Row -->
            <div class="row MoviePage__Top">
                <div class="col-md-4 MoviePage__Image">
                    @if($movieAlbum->first() === null)
                        {!! Html::image('https://upload.wikimedia.org/wikipedia/commons/d/d2/Question_mark.svg',
                        'questionMark_image', array('width' => '100%', 'height' => 'auto')) !!} <br/>
                    @else
                        <img src="{{ url($movieAlbum->first()->getPath()) }}" class="img-responsive"
                             style="width: 100%; height: auto;">
                    @endif

                    @if(Auth::check())
                        <button type="button" class="btn MoviePage__btnImage">Add to List</button> <br>
                    @endif

                </div>  <!-- 260 * 420 -->

                <div class="col-md-8 MoviePage__Desc">
                    <h3>Synopsis</h3>
                    <p>
                        @if ($movie->synopsis)
                        {{$movie->synopsis}}
                        @endif
                    </p>
                    <h3>Movie Details</h3>
                    <ul class="list-group MoviePage__listGroup">
                        <li class="list-group-item MoviePage__listGroupItem">Director:<span class="MoviePage__directorText">
                            @if ($director)
                                {{$director->first_name}} {{$director->last_name}}
                            @endif
                        </span></li>
                        <li class="list-group-item MoviePage__listGroupItem">Country:<span class="MoviePage__countryText">
                                @if($movie->country)
                                    {{$movie->country}}
                                @endif
                            </span></li>
                        <li class="list-group-item MoviePage__listGroupItem">Genre:<span class="MoviePage__genreText">
                                @if($movie->genre)
                                    {{$movie->genre}}
                                @endif
                            </span></li>
                        <li class="list-group-item MoviePage__listGroupItem">Parental Rating:<span class="MoviePage__ratingText">
                                @if($movie->parental_rating)
                                    {{$movie->parental_rating}}
                                @endif
                            </span></li>
                        <li class="list-group-item MoviePage__listGroupItem">Release Date:<span class="MoviePage__releaseText">
                                @if($newDate)
                                    {{$newDate}}
                                @endif
                            </span></li>
                        <li class="list-group-item MoviePage__listGroupItem">Length:<span class="MoviePage__lengthText">
                                @if($movie->runtime)
                                    {{$movie->runtime}} minutes
                                @endif
                            </span></li>
                    </ul>
                </div>

            </div>
            <!-- /.row -->

            <!-- Second Row -->
            <div class="row MoviePage__Second">
                <div class="col-lg-12">
                    <h3 class="page-header">Pictures</h3>
                </div>

                @include('images.albumPreview', ['album' => $album, 'maxImages' => 8])
                <a href="{{ '/album/movie/' . $movie->id }}"><button type="button" class="btn PersonPage__btnRedirect">View All Pictures</button></a>
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
                    @if($firstPersonCast !== null)
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
                                            <img src="http://www.politicspa.com/wp-content/uploads/2013/02/Silhouette-question-mark.jpeg"
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
                                    {{$firstPersonRole->character_name}}
                                </td>
                            </tr>
                            @if($newCastCollection !== null)
                                @foreach($newCastCollection as $cast)
                                    <tr class="collapse row1">
                                        <td align ="center">
                                            @if($cast->default === null)
                                                <img src="http://www.politicspa.com/wp-content/uploads/2013/02/Silhouette-question-mark.jpeg"
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
                                            {{$cast->character_name}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    @else
                        <p>There doesn't seem to be any cast for this movie!</p>
                    @endif
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
                    @if ($firstPersonCrew !== null)
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
                                        <img src="http://www.politicspa.com/wp-content/uploads/2013/02/Silhouette-question-mark.jpeg"
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
                                @if ($firstPersonCrew !== null)
                                    <td>{{$firstPersonCrew->first_name}} {{$firstPersonCrew->last_name}}</td>
                                    <td align="left">...</td>
                                    <td align="left">
                                        @if($firstPersonCrew->type === 'Crew')
                                            {{$firstPersonCrew->remark}}
                                        @else
                                            {{$firstPersonCrew->type}}
                                        @endif
                                    </td>
                                @endif
                            </tr>
                            @if ($newCrewCollection !== null)
                                @foreach($newCrewCollection as $crew)
                                    <tr class="collapse row1A">
                                        <td align ="center">
                                            @if($crew->default === null)
                                                <img src="http://www.politicspa.com/wp-content/uploads/2013/02/Silhouette-question-mark.jpeg"
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
                                    }
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    @else
                        <p>There doesn't seem to be any crew for this movie!</p>
                    @endif
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
        @else
            <p class="MoviePage__errorMessage">We're sorry, that movie doesn't seem to exist! <br/>
                                                Try searching for another movie.</p>
        @endif
    </div>
@endsection