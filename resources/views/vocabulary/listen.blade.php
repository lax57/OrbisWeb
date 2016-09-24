@extends('layouts.dashboard')

@section('page-content')
<div class="page-content-wrapper">
    <div id="vocabulary-page" class="page-content" style="min-height:509px">
        <div class="page-title uppercase">
            @include('includes.vocabulary.progressbar')
        </div>
        <div class="flex-row row ">
            <div class="col-md-3">
                @include('includes.vocabulary.stat')
            </div>
            <div class="col-md-9">
                <div class="vocabulary-container description-box">
                    <div class="heading uppercase">
                        Słownictwo - Wysłuchaj i zapisz
                    </div>
                    <div class="content">
                        <h1 id="hearicon"><i class="fa fa-volume-up" aria-hidden="true"></i></h1>
                        <input type="text" class="form-control" placeholder="Wpisz słowo">
                    </div>
                </div>

            </div>
        </div>

        @include('includes.vocabulary.navbuttons')

    </div>
</div>
@endsection