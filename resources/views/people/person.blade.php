<!-- Ashley created file on $(DATE) -->

@extends('layouts.app')

@section('content')

    <div class="container">

        <!-- Person Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> {{$person->getBestName()}}
                    @can('edit_all_content')
                        <a href="#"><button type="button" class="btn PersonPage__btnAdmin">Edit Person</button></a>
                        <a href="#"><button type="button" class="btn PersonPage__btnAdmin">Delete Person</button></a>
                    @endcan
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Top Person Page Row -->
        <div class="row PersonPage__Top">

            <div class="col-md-4 PersonPage__Image">
                <img class="PersonPage__poster" src="http://a3.files.biography.com/image/upload/c_fill,cs_srgb,dpr_1.0,g_face,h_300,q_80,w_300/MTE5NDg0MDU1MTIyMTE4MTU5.jpg"
                     width="300px" height="400px" alt="">

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

            <div class="col-md-6">
                <p>This section is reserved for a horizontal view of person pictures.</p>
            </div>
        </div>
        <!-- /.row -->

        <!-- Third Row -->
        <div class="row PersonPage__Third">

            <div class="col-lg-12">
                <h3 class="page-header">Movies starred in
                    <small class="PersonPage__tableInfo">(Click to expand/collapse)</small>
                </h3>
            </div>

            <div class="col-md-12 PersonPage__cast">

                <table class="table table-responsive table-hover">
                    <thead>
                    <tr><th>Picture</th><th>Name</th><th></th><th>Role</th></tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><img src="http://vignette4.wikia.nocookie.net/planetterror/images/f/f4/Michael...jpeg/revision/latest?cb=20140220162656" width="35" height="50"></td>
                        <td>Michael Biehn</td>
                        <td>...</td>
                        <td>Kyle Reese</td>
                    </tr>
                    <tr>
                        <td><img src="http://vignette4.wikia.nocookie.net/planetterror/images/f/f4/Michael...jpeg/revision/latest?cb=20140220162656" width="35" height="50"></td>
                        <td>Michael Biehn</td>
                        <td>...</td>
                        <td>Kyle Reese</td>
                    </tr>
                    <tr class="clickable" data-toggle="collapse" id="row1" data-target=".row1">
                        <td><img src="http://popwrapped.com/wp-content/uploads/2015/07/o-ARNOLD-SCHWARZENEGGER-ILL-BE-BACK-facebook.jpg" width="35" height="50"></td>
                        <td>Arnold Schwarzenegger</td>
                        <td>...</td>
                        <td>The Terminator</td>
                    </tr>
                    <tr class="collapse row1">
                        <td><img src="http://vignette4.wikia.nocookie.net/planetterror/images/f/f4/Michael...jpeg/revision/latest?cb=20140220162656" width="35" height="50"></td>
                        <td>Michael Biehn</td>
                        <td>...</td>
                        <td>Kyle Reese</td>
                    </tr>
                    <tr class="collapse row1">
                        <td><img src="http://vignette4.wikia.nocookie.net/planetterror/images/f/f4/Michael...jpeg/revision/latest?cb=20140220162656" width="35" height="50"></td>
                        <td>Michael Biehn</td>
                        <td>...</td>
                        <td>Kyle Reese</td>
                    </tr>
                    <tr class="collapse row1">
                        <td><img src="http://vignette4.wikia.nocookie.net/planetterror/images/f/f4/Michael...jpeg/revision/latest?cb=20140220162656" width="35" height="50"></td>
                        <td>Michael Biehn</td>
                        <td>...</td>
                        <td>Kyle Reese</td>
                    </tr>
                    <tr class="collapse row1">
                        <td><img src="http://vignette4.wikia.nocookie.net/planetterror/images/f/f4/Michael...jpeg/revision/latest?cb=20140220162656" width="35" height="50"></td>
                        <td>Michael Biehn</td>
                        <td>...</td>
                        <td>Kyle Reese</td>
                    </tr>
                    <tr class="collapse row1">
                        <td><img src="http://vignette4.wikia.nocookie.net/planetterror/images/f/f4/Michael...jpeg/revision/latest?cb=20140220162656" width="35" height="50"></td>
                        <td>Michael Biehn</td>
                        <td>...</td>
                        <td>Kyle Reese</td>
                    </tr>
                    <tr class="collapse row1">
                        <td><img src="http://vignette4.wikia.nocookie.net/planetterror/images/f/f4/Michael...jpeg/revision/latest?cb=20140220162656" width="35" height="50"></td>
                        <td>Michael Biehn</td>
                        <td>...</td>
                        <td>Kyle Reese</td>
                    </tr>
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