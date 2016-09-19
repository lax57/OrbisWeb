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
        @include('includes.emptypage', ['message' => 'Nie jesteś zapisany na żadne kursy', 'submessage' => 'Wybierz jeden z kursów z zakładki Przeglądaj i rozpocznij naukę z Orbis!'])
    </div>

    <script src="./js/app.js"></script>
</body>
@endsection