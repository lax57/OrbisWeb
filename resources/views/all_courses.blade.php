@extends('layouts.dashboard')

@section('page-content')
<div class="page-content-wrapper">
    <div id="page-content" class="page-content" style="min-height:509px">

        <div class="page-title">
            @include('includes.filterbar', ['title' => trans('navbar.available_courses')])
        </div>
        @include('includes.coursegrid')

    </div>
</div>
@endsection
