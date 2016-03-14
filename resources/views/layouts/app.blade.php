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

		<div class="navbar-form navbar-left" role="search">
		    {!! Form::open() !!}
		    {!! Form::text('search', null, ['class' => 'form-group form-control', 'placeholder' => 'Search']) !!}
		    {!! Form::submit('Submit', ['class' => 'btn btn-default']) !!}
		    {!! Form::close() !!}
		</div>	
                <!-- <form class="navbar-form navbar-left" role="search"> -->
                <!--     <div class="form-group"> -->
                <!--         <input type="text" class="form-control" placeholder="Search"> -->
                <!--     </div> -->
                <!--     <button type="submit" class="btn btn-default">Submit</button> -->
                <!-- </form> -->

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

<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{ elixir('js/bundle.js') }}"></script>
