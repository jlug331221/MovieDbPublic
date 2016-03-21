<!-- Ashley created file on $(DATE) -->

@extends('layouts.app')

@section('content')

    <div class="container">

        <!-- Movie Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">The Terminator
                    <small>(1984)</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Top Movie Page Row -->
        <div class="row MoviePage__Top">

            <div class="col-md-3 MoviePage__Buttons">
                <button type="button" class="btn MoviePage__btn">Add to List</button> <br>
                <button type="button" class="btn MoviePage__btn">View Discussions</button> <br>
                <button type="button" class="btn MoviePage__btn">Edit Movie</button> <br>
                <button type="button" class="btn MoviePage__btn">Delete Movie</button> <br>
            </div>

            <div class="col-md-3 MoviePage__Image">
                <img class="img-responsive MoviePage__poster" src="http://www.cinemasterpieces.com/term1.jpg" width="260px" height="420px" alt="">
            </div>

            <div class="col-md-6">
                <h3>Movie Description</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius
                    vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim.</p>
                <h3>Movie Details</h3>
                <ul class="list-group MoviePage__listGroup">
                    <li class="list-group-item MoviePage__listGroupItem">Director:</li>
                    <li class="list-group-item MoviePage__listGroupItem">Country:</li>
                    <li class="list-group-item MoviePage__listGroupItem">Genre:</li>
                    <li class="list-group-item MoviePage__listGroupItem">Parental Rating:</li>
                    <li class="list-group-item MoviePage__listGroupItem">Release Date:</li>
                </ul>
            </div>

        </div>
        <!-- /.row -->

        <!-- Second Row -->
        <div class="row MoviePage__Middle">

            <div class="col-lg-12">
                <h3 class="page-header">The Cast</h3>
            </div>

            <div class="col-md-12 MoviePage__cast">
                    <table class="table table-fixed">
                        <thead>
                        <tr>
                            <th class="col-md-3">Picture</th><th class="col-md-3">Name</th><th class="col-md-3"></th><th class="col-md-3">Role</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">Arnold Schwarzenegger</td>
                            <td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">The Terminator</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">That girl</td><td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">Sarah Connor</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">This guy</td><td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">John Connor</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">Tom Cruise</td><td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">Wasn't actually in the movie</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">Arnold Schwarzenegger</td>
                            <td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">The Terminator</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">That girl</td><td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">Sarah Connor</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">This guy</td><td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">John Connor</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">Tom Cruise</td><td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">Wasn't actually in the movie</td>
                        </tr><tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">Arnold Schwarzenegger</td>
                            <td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">The Terminator</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">That girl</td><td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">Sarah Connor</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">This guy</td><td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">John Connor</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">Tom Cruise</td><td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">Wasn't actually in the movie</td>
                        </tr><tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">Arnold Schwarzenegger</td>
                            <td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">The Terminator</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">That girl</td><td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">Sarah Connor</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">This guy</td><td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">John Connor</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">Tom Cruise</td><td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">Wasn't actually in the movie</td>
                        </tr><tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">Arnold Schwarzenegger</td>
                            <td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">The Terminator</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">That girl</td><td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">Sarah Connor</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">This guy</td><td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">John Connor</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><img src="https://www.samhober.com/howtofoldpocketsquares/Flat1.jpg" class="img-thumbnail" width="20" height="20"></td>
                            <td class="col-md-3">Tom Cruise</td><td class="col-md-3 MoviePage__tableCenter">...</td><td class="col-md-3">Wasn't actually in the movie</td>
                        </tr>
                    </table>
            </div>
        </div>
        <!-- /.row -->

        <!-- Third Row -->
        <div class="row MoviePage__Bottom">

            <div class="col-lg-12">
                <h3 class="page-header"></h3>
            </div>

            <div class="col-md-6">
                <p>I am reserving this section for reviews.</p>
            </div>


        </div>
    </div>
@endsection