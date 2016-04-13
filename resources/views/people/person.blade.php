<!-- Ashley created file on $(DATE) -->

@extends('layouts.app')

@section('content')

    <div class="container">

        <!-- Person Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> {{$person->getBestName()}}
                    @can('edit_all_content')
                        <a href="{{ url('/admin/showPerson/' . $person->id) }}"><button type="button" class="btn PersonPage__btnAdmin">Edit Person</button></a>
                        <a href="{{ url('/admin/deletePerson/' . $person->id) }}"><button type="button" class="btn PersonPage__btnAdmin">Delete Person</button></a>
                    @endcan
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Top Person Page Row -->
        <div class="row PersonPage__Top">

            <div class="col-md-4 PersonPage__Image">
                @if($personAlbum->first() === null)
                    {!! Html::image('http://masterherald.com/wp-content/uploads/2015/01/arnold-schwarzenegger.jpg',
                    'arnold_image', array('width' => '100%', 'height' => 'auto')) !!} <br/>
                    <h3>Arnold is wondering why this movie has no images</h3>
                @else
                    <img src="{{ url($personAlbum->first()->getPath()) }}" class="img-responsive"
                         style="width: 100%; height: auto;">
                @endif
                @if(Auth::check())
                    <button type="button" class="btn PersonPage__btnImage">Add to List</button> <br>
                @endif
            </div>

            <div class="col-md-8 PersonPage__Desc">
                <h3>Biography</h3>
                <p>
                    {{$person->biography}}
                </p>
                <h3>Person Details</h3>
                <ul class="list-group PersonPage__listGroup">
                    <li class="list-group-item PersonPage__listGroupItem">Full name:<span class="PersonPage__fullNameText">{{$person->first_name}} {{$person->middle_name}} {{$person->last_name}}</span></li>
                    <li class="list-group-item PersonPage__listGroupItem">Alias:<span class="PersonPage__aliasText">{{$person->first_alias}} {{$person->middle_alias}} {{$person->last_alias}}</span></li>
                    <li class="list-group-item PersonPage__listGroupItem">Country of Origin:<span class="PersonPage__countryText"> {{$person->country_of_origin}}</span></li>
                    <li class="list-group-item PersonPage__listGroupItem">Date of birth:<span class="PersonPage__DOBText">{{$dateOfBirth}}</span></li>
                    <li class="list-group-item PersonPage__listGroupItem">Date of death:<span class="PersonPage__DODText">{{$dateOfDeath}}</span></li>
                </ul>
            </div>

        </div>
        <!-- /.row -->

        <!-- Second Row -->
        <div class="row PersonPage__Second">
            <div class="col-lg-12">
                <h3 class="page-header">Pictures</h3>
            </div>

            @include('images.albumPreview')
        </div>
        <!-- /.row -->

        <!-- Third Row -->
        <div class="row PersonPage__Third">

            <div class="col-lg-12">
                <h3 class="page-header">Filmography
                    <small class="PersonPage__tableInfo">(Click to expand/collapse)</small>
                </h3>
            </div>

            <div class="col-md-12 PersonPage__cast">

                <table class="table table-responsive table-hover">
                    <thead>
                    <tr>
                        <th style="text-align: center">Picture</th>
                        <th style="text-align: left">Movie</th><th></th>
                        <th style="text-align: left">Role</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="clickable" data-toggle="collapse" id="row1" data-target=".row1">
                        <td align ="center">
                            @if($firstMovieStarredIn->default === null)
                                <img src="http://popwrapped.com/wp-content/uploads/2015/07/o-ARNOLD-SCHWARZENEGGER-ILL-BE-BACK-facebook.jpg"
                                     class="img-responsive center-block"
                                     style="height:85px;">
                            @else
                                <img src="{{ url($firstMovieStarredIn->path . '/thumbs/'
                                        . $firstMovieStarredIn->name . '.'
                                        . $firstMovieStarredIn->extension)}}"
                                     class="img-responsive center-block"
                                     style="height: 85px;">
                            @endif
                        </td>
                        <td>{{$firstMovieStarredIn->title}}</td>
                        <td align="left">...</td>
                        <td align="left">
                            @if($firstMovieStarredIn->type === 'Crew')
                                {{$firstMovieStarredIn->remark}}
                            @else
                                {{$firstMovieStarredIn->character_name}}
                            @endif
                        </td>
                    </tr>
                    @foreach($newMovieCollection as $cast)
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
                            <td>{{$cast->title}}</td>
                            <td align="left">...</td>
                            <td align="left">
                                @if($cast->type === 'Crew')
                                    {{$cast->remark}}
                                @else
                                    {{$cast->character_name}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->

        <!-- Fourth Row -->
        <div class="row PersonPage__Fourth">

            <div class="col-lg-12">
                <h3 class="page-header">Discussions</h3>
            </div>

            <div class="col-md-6">
                <p>This section is potentially for person discussions.</p>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection