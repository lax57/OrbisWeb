@extends('layouts.dashboard')

@section('page-content')
<div class="page-content-wrapper">
    <div id="course-page" class="page-content" style="min-height:509px">
        <div class="page-title uppercase">
            <div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70"
                    aria-valuemin="0" aria-valuemax="100" style="width:70%">
                    70%
                </div>
            </div>
        </div>
        <div class="flex-row row ">
            <div class="col-md-5">
                <div class="large-course-box-wrapper">

                    <div class="course-box flip-container" data-courseid="{{$course->id}}" ontouchstart="this.classList.toggle('hover');">
                        <div class="flipper">
                            <div class="image-container front">
                                <img src="{{URL::asset('img/medium-'.$course->img_file)}}" alt="" title="" />
                                <div class="course-name" style="font-size:1.5em">
                                    <span class="uppercase">{{$course->name}} {{$course->level}}</span>
                                </div>
                            </div>

                            <div class="back">
                                <div class="">
                                    {{trans('course_page.lorem_ipsum') }}
                                </div>
                            </div>
                        </div>
                        <a id="leave-course" class="btn btn-default btn-transparent-red">
                            {{trans('course_page.leave_course') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="description-box" style="height:66%">
                    <div class="heading uppercase">
                        {{trans('course_page.description') }}
                    </div>
                    <div class="content">
                        {{trans('course_page.lorem_ipsum') }}
                    </div>
                </div>

                <ul class="course-actions list-inline">
                    <li>
                        <div class="overlay-item">
                            <a href="{{route('lessons_overview',['course_id'=>$course->id])}}" class="hover-img text-white" href="#">
                                <span class="bg-mask"></span>
                                <img src="{{URL::asset('img/medium-book.jpg')}}" />
                                <span class="hover-icon fa fa-graduation-cap fa-3x icon hidden-xs"></span>
                                <span class="hover-title-center hover-hold">{{trans('course_page.start') }}</span>
                                <span class="overlay-red"></span>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="overlay-item">
                            <a class="hover-img text-white" href="#">
                                <span class="bg-mask"></span>
                                <img src="{{URL::asset('img/medium-blackboard.jpg')}}" />
                                <span class="hover-icon fa fa-repeat fa-3x icon hidden-xs"></span>
                                <span class="hover-title-center hover-hold">
                                    {{trans('course_page.repeat') }}
                                    <br />{{trans('course_page.grammar') }}
                                </span>
                                <span class="overlay-red"></span>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="overlay-item">
                            <a class="hover-img text-white" href="#">
                                <span class="bg-mask"></span>
                                <img src="{{URL::asset('img/medium-students.jpg')}}" />
                                <span class="hover-icon fa fa-repeat fa-3x icon hidden-xs"></span>
                                <span class="hover-title-center hover-hold">
                                    {{trans('course_page.repeat') }}
                                    <br />{{trans('course_page.vocabulary') }}
                                </span>
                                <span class="overlay-red"></span>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="overlay-item">
                            <a class="hover-img text-white" href="#">
                                <span class="bg-mask"></span>
                                <img src="{{URL::asset('img/medium-open-book.jpg')}}" />
                                <span class="hover-icon fa fa-graduation-cap fa-3x icon hidden-xs"></span>
                                <span class="hover-title-center hover-hold">{{trans('course_page.continue') }}</span>
                                <span class="overlay-red"></span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection