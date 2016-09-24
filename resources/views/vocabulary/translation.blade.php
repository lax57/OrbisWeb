@extends('layouts.dashboard')

@section('page-content')
<div class="page-content-wrapper">
    <div id="vocabulary-intro-page" class="page-content" style="min-height:509px">
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
                        Słownictwo - Wprowadzenie
                    </div>
                    <div class="content">
                        <h1 id="word">Słowo</h1>
                        <input type="text" id="translation-input" class="form-control" placeholder="Wpisz słowo">

                    </div>
                </div>

            </div>
        </div>

        @include('includes.vocabulary.navbuttons')

    </div>
</div>
@endsection