@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <label class="col-md-12 Layout__welcome">Welcome to PeeDeeDb!</label>
    </div>
    <div class="row">

        <!-- Top 10 section -->

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Top 10 movies of the month!</div>
                    <div class="panel-body Layout__panel-body">
                        <div class="col-md-12">
                            Top 10 movie list
                        </div>
                    </div>
            </div>
        </div>

       <!-- Login Box -->
        @if(!Auth::check())
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Login!</div>
                <div class="panel-body Layout__panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} Layout__form-group">
                            <label class="col-md-4 control-label Layout__form-label">E-Mail Address</label>

                            <div class="col-md-6 Layout__input-holder">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} Layout__form-group">
                            <label class="col-md-4 control-label Layout__form-label">Password</label>

                            <div class="col-md-6 Layout__input-holder">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group Layout__form-block">
                            <div class="col-md-5">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Login
                                </button>
                            </div>
                        </div>
                        <div class="form-group Layout__form-block">
                            <div class="col-md-12 Layout__form-checkbox-holder">
                                <div class="row">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                        </div>
                    </form>
                </div>
        </div>
    </div>
            @endif  <!--End of Login box-->

        <!--Recently added movies-->
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently released movies!</div>
                <div class="panel-body Layout__panel-body">
                    @foreach($recentmovie as $movie)
                        <div class = "row">
                            <div class="col-md-12">
                                <a href="{{url('/movies/'.$movie->id)}}">{{$movie->title}}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!--Register box-->
            @if(!Auth::check())
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">No login? Register now!</div>
                <div class="panel-body Layout__panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} Layout__form-group">
                            <label class="col-md-4 control-label Layout__form-label">Name</label>

                            <div class="col-md-6 Layout__input-holder">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} Layout__form-group">
                            <label class="col-md-4 control-label Layout__form-label">E-Mail Address</label>

                            <div class="col-md-6 Layout__input-holder">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} Layout__form-group">
                            <label class="col-md-4 control-label Layout__form-label">Password</label>

                            <div class="col-md-6 Layout__input-holder">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} Layout__form-group">
                            <label class="col-md-4 control-label Layout__form-label" id="Layout__confirm-password">Confirm Password</label>

                            <div class="col-md-6 Layout__input-holder">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group Layout__form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                @endif  <!--End of register box-->

        <!--Recent review box-->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added reviews!</div>
                <div class="panel-body Layout__panel-body">
                    <div class="col-md-12">
                    @foreach ($reviews as $review)
                        @include('reviews.reviewComponent')
                    @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!--Recent discussion box-->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added discussions!</div>
                <div class="panel-body Layout__panel-body">
                    <div class="col-md-12">
                        @foreach ($discussions as $discussion)
                            @include('discussions.discussionComponent')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

</div>
@endsection
