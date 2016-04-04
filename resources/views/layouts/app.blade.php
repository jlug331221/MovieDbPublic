{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PDDB</title>

    <!-- Styles -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    PDDB
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/userpage/home') }}">Home</a></li>
                </ul>

    		{!! Form::open(['class' => 'navbar-form navbar-left', 'url' => 'search', 'role' => 'search']) !!}
                <div style="display: flex">
                    <input type="text"
                           class="form-control"
                           placeholder="Search"
                           id="MenubarSearch__input">
                    <button class="btn btn-default" 
                            type="submit"
                            id="MenubarSearch__submit">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </div>
    		{!! Form::close() !!}

                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#"
                           class="dropdown-toggle"
                           data-toggle="dropdown"
                           role="button"
                           aria-haspopup="true"
                           aria-expanded="false">
                            Advanced Search
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/search/movie') }}">
                                    Movie Search
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/search/person') }}">
                                    Person Search
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                {{--@if(Auth::check() && Auth::user()->hasRole('Administrator'))--}}
                @can('edit_all_content')
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/admin/adminHome') }}">Admin Dashboard</a></li>
                    </ul>
                @endcan
                {{--@endif--}}


                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

</body>
</html>

<!-- js -->
<script src="{{ elixir('js/bundle.js') }}"></script>
