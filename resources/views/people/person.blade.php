<!-- Ashley created file on $(DATE) -->

@extends('layouts.app')

@section('content')

    <div class="container">

        <!-- Person Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Arnold Schwarzenegger
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
                <p>Arnold Alois Schwarzenegger (/ˈʃwɔːrtsənˌɛɡər/; German: [ˈaɐ̯nɔlt ˈalɔʏs ˈʃvaɐ̯tsn̩ˌɛɡɐ]; born July 30, 1947) is an Austrian-American actor, filmmaker, businessman, investor, author, philanthropist, activist, former professional bodybuilder and politician. He served two terms as the 38th Governor of California from 2003 until 2011.
                    Schwarzenegger began weight training at the age of 15. He won the Mr. Universe title at age 20
                    and went on to win the Mr. Olympia contest seven times. Schwarzenegger has remained a prominent presence
                    in bodybuilding and has written many books and articles on the sport. He is widely considered to be among the greatest
                    bodybuilders of all times as well as its biggest icon.[2] Schwarzenegger gained worldwide fame as a Hollywood action film icon.
                    His breakthrough film was the sword-and-sorcery epic Conan the Barbarian in 1982, which was a box-office hit and resulted
                    in a sequel.[3] In 1984, he appeared in James Cameron's science-fiction thriller film The Terminator, which was a massive
                    critical and box-office success. Schwarzenegger subsequently reprised the Terminator character in the franchise's later
                    installments in 1991, 2003, and 2015.[3][4][5] He appeared in a number of successful films, such as Commando (1985),
                    The Running Man (1987), Predator (1987), Twins (1988), Total Recall (1990), Kindergarten Cop (1990) and True Lies (1994).
                    He was nicknamed the "Austrian Oak" in his bodybuilding days, "Arnie" during his acting career, and "The Governator"
                    (a portmanteau of "Governor" and "The Terminator", one of his best-known movie roles).

                </p>
                <h3>Person Details</h3>
                <ul class="list-group PersonPage__listGroup">
                    <li class="list-group-item PersonPage__listGroupItem">Full name:<span class="PersonPage__fullNameText">Arnold Alois Schwarzenegger</span></li>
                    <li class="list-group-item PersonPage__listGroupItem">Alias:<span class="PersonPage__aliasText">Arnold Alois Schwarzenegger</span></li>
                    <li class="list-group-item PersonPage__listGroupItem">Country of Origin:<span class="PersonPage__countryText">Austria</span></li>
                    <li class="list-group-item PersonPage__listGroupItem">Date of birth:<span class="PersonPage__DOBText">July 30, 1947</span></li>
                    <li class="list-group-item PersonPage__listGroupItem">Date of death:<span class="PersonPage__DODText">Arnold Alois Schwarzenegger</span></li>
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