@extends('layouts.app')

@section('content')
<div class = "banner">
    </div>
            <div class = "container">
                <h1>Discussion Board</h1>
                <div class = "leftTop">
                </div>

                <div class = "rightTop">
                    <button type="button">Create New Discussion</button>
                    <hr />
                </div>
            </div>

            <div class = "container">

                <div class = "leftBoard">

                    <p>
                        <a>{{$discussions->title}}</a>
                    </p>
                    <p>
                        by
                    </p>

                    <p>
                        <a></a>
                    </p>

                </div>

                    <div class = "rightBoard">
                    <img src="Users/claytonjohnson/WebstormProjects/DB_Page/images/user_clay.png" alt =  "userpic" height = 120 width = 100/>
                </div>

            </div>

            <div class = "horizontalLine">
                <hr />
            </div>

            <div class = "container">

                <div class = "leftBoard">

                    <p>
                        <a href="url">Topic Title</a>
                    </p>
                    <p>
                        by
                    </p>

                    <p>
                        <a href="url">User</a>
                    </p>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection