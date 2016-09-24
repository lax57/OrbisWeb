@extends('layouts.dashboard')

@section('page-content')
<div class="page-content-wrapper">
    <div id="page-content" class="page-content" style="min-height:509px">

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="lesson-title-page">
                        <h1>Lekcja 1</h1>
                    </div>
                    <div class="description-container">
                        <div class="description-box" style="height:100%">
                            <div class="heading uppercase">
                                {{trans('lessons_overview.description') }}
                            </div>
                            <div class="content">
                                <p>{{trans('course_page.lorem_ipsum') }}</p>
                            </div>
                            <div class="actions">
                                <ul class="list-inline">
                                    <li style="text-align:center"><a href="{{route('vocabulary_intro', ['course_id' => 1, 'lesson_id' => 1 ])}}"><i class="fa fa-book fa-4x" aria-hidden="true"></i><p>Słownictwo</p></a></li>
                                    <li><i class="fa fa-language fa-4x" aria-hidden="true"></i><p>Gramatyka</p></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="item">
                    <div class="lesson-title-page">
                        <h1>Lekcja 1</h1>
                    </div>
                    <div class="description-container">
                        <div class="description-box" style="height:100%">
                            <div class="heading uppercase">
                                {{trans('lessons_overview.description') }}
                            </div>
                            <div class="content">
                                <p>{{trans('course_page.lorem_ipsum') }}</p>
                            </div>
                            <div class="actions">
                                <ul class="list-inline">
                                    <li style="text-align:center"><a href="{{route('vocabulary_intro', ['course_id' => 1, 'lesson_id' => 1 ])}}"><i class="fa fa-book fa-4x" aria-hidden="true"></i><p>Słownictwo</p></a></li>
                                    <li><i class="fa fa-language fa-4x" aria-hidden="true"></i><p>Gramatyka</p></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="item">
                    <div class="lesson-title-page">
                        <h1>Lekcja 1</h1>
                    </div>
                    <div class="description-container">
                        <div class="description-box" style="height:100%">
                            <div class="heading uppercase">
                                {{trans('lessons_overview.description') }}
                            </div>
                            <div class="content">
                                <p>{{trans('course_page.lorem_ipsum') }}</p>
                            </div>
                            <div class="actions">
                                <ul class="list-inline">
                                    <li style="text-align:center"><i class="fa fa-book fa-4x" aria-hidden="true"></i><p>Słownictwo</p></li>
                                    <li><i class="fa fa-language fa-4x" aria-hidden="true"></i><p>Gramatyka</p></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <i class="fa fa-chevron-left fa-3x" aria-hidden="true"></i>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <i class="fa fa-chevron-right fa-3x" aria-hidden="true"></i>
            </a>
        </div> <!-- Carousel -->
    </div>
</div>
@endsection

