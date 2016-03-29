<!-- Ashley created file on $(DATE) -->

@extends('layouts.app')

@section('content')

    <div class="container">

        <!-- Movie Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">The Terminator
                    <small>(1984)</small>
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
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius
                    vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius
                    vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius
                    vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim.

                </p>
                <h3>Movie Details</h3>
                <ul class="list-group MoviePage__listGroup">
                    <li class="list-group-item MoviePage__listGroupItem">Director:<span class="MoviePage__directorText">James Cameron</span></li>
                    <li class="list-group-item MoviePage__listGroupItem">Country:<span class="MoviePage__countryText">United States</span></li>
                    <li class="list-group-item MoviePage__listGroupItem">Genre:<span class="MoviePage__genreText">Action</span></li>
                    <li class="list-group-item MoviePage__listGroupItem">Parental Rating:<span class="MoviePage__ratingText">PG-13</span></li>
                    <li class="list-group-item MoviePage__listGroupItem">Release Date:<span class="MoviePage__releaseText">October 26, 1984</span></li>
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
        <div class="row MoviePage__Fourth">

            <div class="col-lg-12">
                <h3 class="page-header">Reviews</h3>
            </div>

            <div class="col-md-6">
                <p>I am reserving this section for reviews.</p>
            </div>
        </div>
        <!-- /.row -->

        <!-- Fifth Row -->
        <div class="row MoviePage__Fifth">

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