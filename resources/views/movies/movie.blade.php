<!-- Ashley created file on $(DATE) -->

@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row MoviePage col-sm-12">
            <h1>The Terminator (1984)</h1>
            <hr>

            <!-- Movie Poster -->
            <div class="MoviePage__left col-sm-4">
                <img src="http://www.movieposter.com/posters/archive/main/14/A70-7230" class="MoviePage__image" width="350" height="500">
            </div>


            <div class="row MoviePage__right col-sm-8">

                <!-- Movie Description/Plot -->
                 <div class="Well MoviePage__desc col-sm-8">
                    A human-looking indestructible cyborg is sent from 2029 to 1984 to assassinate a waitress,
                    whose unborn son will lead humanity in a war against the machines, while a soldier from that
                    war is sent to protect her at all costs.
                </div>

                <!-- Movie Details Table -->

                    <table class="MoviePage__table table-striped col-sm-8">
                        <tbody>
                        <tr>
                            <td><h4 class="MoviePage__bold">Director: </h4></td>
                            <td>James Cameron</td>
                        </tr>
                        <tr>
                            <td><h4 class="MoviePage__bold">Country of Origin: </h4></td>
                            <td>United States</td>
                        </tr>
                        <tr>
                            <td><h4 class="MoviePage__bold">Genre: </h4></td>
                            <td>Action</td>
                        </tr>
                        <tr>
                            <td><h4 class="MoviePage__bold">Parental Rating: </h4></td>
                            <td>R</td>
                        </tr>
                        <tr>
                            <td><h4 class="MoviePage__bold">Release Date: </h4></td>
                            <td>1/1/1984</td>
                        </tr>
                        </tbody>
                    </table>


                <!-- Movie Cast Table Header -->
                <div class="MoviePage__header col-sm-8">
                    <h3>Cast:</h3>
                </div>

                <!-- Movie Cast Table
                <div class="MoviePage__cast col-sm-8">
                    <table class="MoviePage__tableCast table-striped">
                        <tbody>
                        <tr>
                            <td><img src="http://ia.media-imdb.com/images/M/MV5BMTI3MDc4NzUyMV5BMl5BanBnXkFtZTcwMTQyMTc5MQ@@._V1_UY317_CR19,0,214,317_AL_.jpg"
                                     alt="Cinque Terre" width="10" height="15"></td>
                            <td class="col-md-3">Arnold Schwarzenegger</td>
                            <td class="col-md-4">The Terminator</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><h4 class="MoviePage__bold">Country of Origin: </h4></td>
                            <td class="col-md-4">United States</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><h4 class="MoviePage__bold">Genre: </h4></td>
                            <td class="col-md-4">Action</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><h4 class="MoviePage__bold">Parental Rating: </h4></td>
                            <td class="col-md-4">R</td>
                        </tr>
                        <tr>
                            <td class="col-md-3"><h4 class="MoviePage__bold">Release Date: </h4></td>
                            <td class="col-md-4">1/1/1984</td>
                        </tr>
                        </tbody>
                    </table>
                </div> -->
            </div>
        </div>
    </div>
@endsection