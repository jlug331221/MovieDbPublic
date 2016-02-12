<!DOCTYPE HTML>

<html>

<head>
    <meta charset="UTF-8">
    <title>PeeDee</title>
    @section('headLinks')
        <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"> -->
        <!-- <link rel = "stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
        <!-- <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"> -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @show
</head>

<body>

<div>
    @yield('content')
</div>

</body>

</html>