<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <link href="{{URL::asset('fonts/font')}}" rel="stylesheet" />
    <link href="{{URL::asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{URL::asset('css/common.min.css')}}" type="text/css" />

    <link rel="stylesheet" href="{{URL::asset('css/custom.css')}}" type="text/css" />

    <link rel="stylesheet" href="{{URL::asset('css/login.min.css')}}" type="text/css" />

    <link href="{{URL::asset('css/mateusz.css')}}" rel="stylesheet" type="text/css" />


    <script src="{{URL::asset('js/jquery-3.1.0.min.js')}}"></script>

    
</head>
@yield('body')
</html>
