@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('body')
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white home" style="overflow: hidden;">
    <!-- BEGIN HEADER -->

    @include('includes.topmenu')

    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">

        <!-- BEGIN SIDEBAR -->
        @include('includes.navbar')
        <!-- END SIDEBAR -->

        <!-- BEGIN CONTENT -->
        @include('includes.emptypage', ['message' => 'Nie jesteś zapisany na żadne kursy', 'submessage' => 'Wybierz jeden z kursów z zakładki Przeglądaj i rozpocznij naukę z Orbis!'])
        <!-- END CONTENT -->

    </div>
    <script src="./js/app.js"></script>
</body>
@endsection