@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('body')
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white home">
    @include('includes.topmenu')

    <div class="clearfix"></div>

    <div class="page-container">
        @include('includes.navbar')
        @yield('page-content')
    </div>

    <script src="{{URL::asset('js/isotope.pkgd.min.js')}}"></script>
    <script src="{{URL::asset('js/app.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    
    <script>
        var token = '{{Session::token()}}';
        var courseSignUpUrl = '{{route('course_signup')}}';
        var courseSignOutUrl = '{{route('course_signout')}}';
    </script>
</body>
@endsection