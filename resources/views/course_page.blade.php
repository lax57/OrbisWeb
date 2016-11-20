@extends('layouts.dashboard')

@section('page-content')
<div class="page-content-wrapper">
    <div id="course-page" class="page-content" style="min-height:509px">
        <div class="page-title uppercase">
            <div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70"
                    aria-valuemin="0" aria-valuemax="100" style="width:{{$progress}}%">
                    {{$progress}}%
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
                        <p>{{$course->description}}</p>
                        <p><b>{{trans('course_page.lessons') }}: </b>{{$course->lessons->count()}}</p>
                        <p><b>{{trans('course_page.excercises') }}: </b>{{$tasks_count}}</p>
                        <p><b>{{trans('course_page.words') }}: </b>{{$words_count}}</p>
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
                            <a class="hover-img text-white">
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
    <div class="modal fade" tabindex="-1" role="dialog" id="grammar-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{trans('modal.title_repetition') }}</h4>
                </div>
                <div class="modal-body">

                    <p>
                        @if($task_rep_count>0)
                        <form action="{{route('grammar_repetition')}}" method="post">
                            <select class="selectpicker" name="rep_number">
                                <option>5</option>
                                <option>10</option>
                                <option>20</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                            <input type="hidden" value="{{Session::token()}}" name="_token" />
                            <input type="hidden" value="{{$course->id}}" name="course_id" />
                            <span>{{trans('lessons_overview.from') }} {{$task_rep_count}} {{trans('lessons_overview.possible_units') }}</span>
                            @else
                            <span>{{trans('course_page.no_repetitions') }}</span>
                            @endif
                    </p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('modal.close') }}</button>
                        @if($task_rep_count>0)
                        <button type="submit" class="btn btn-primary" id="goto-word-reps">{{trans('modal.go') }}</button>
                        </form>
                        @endif
                    </div>
                </div>
        </div>
    </div>
    <script>

    </script>
</div>

    <div class="modal fade" tabindex="-1" role="dialog" id="word-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{trans('modal.title_repetition') }}</h4>
                </div>
                <div class="modal-body">

                    <p>
                        @if($word_rep_count>0)
                        <form action="{{route('word_repetition')}}" method="post">
                        <select class="selectpicker" id="wordRepCount" name="rep_number">
                            <option>5</option>
                            <option>10</option>
                            <option>20</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                        <input type="hidden" value="{{Session::token()}}" name="_token" />
                        <input type="hidden" value="{{$course->id}}" name="course_id" />
                        <span>{{trans('lessons_overview.from') }} {{$word_rep_count}} {{trans('lessons_overview.possible_units') }}</span>
                        @else
                        <span>{{trans('course_page.no_repetitions') }}</span>
                        @endif
                    </p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('modal.close') }}</button>
                        @if($word_rep_count>0)
                        <button type="submit" class="btn btn-primary" id="goto-word-reps">{{trans('modal.go') }}</button>
                        </form>
                         @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<!--<p>
                        <div class="btn-group bootstrap-select dropdown">
                            <button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="button" title="Ketchup" aria-expanded="false">
                                <span class="filter-option pull-left">1</span>&nbsp;
                                <span class="bs-caret">
                                <span class="caret"></span></span>
                            </button>
                            <div class="dropdown-menu open" role="combobox" style="max-height: 269px; overflow: hidden; min-height: 0px;">
                            <ul class="dropdown-menu inner" role="listbox" aria-expanded="false" style="max-height: 257px; overflow-y: auto; min-height: 0px;">
                                <li data-original-index="0" class="">
                                    <a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false">
                                        <span class="text">1</span>
                                        <span class="glyphicon glyphicon-ok check-mark"></span>
                                    </a>
                                </li>
                                <li data-original-index="1" class="selected">
                                    <a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="true">
                                        <span class="text">2</span>
                                        <span class="glyphicon glyphicon-ok check-mark"></span>
                                    </a>
                                </li>
                                <li data-original-index="2">
                                    <a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false">
                                        <span class="text">5</span>
                                        <span class="glyphicon glyphicon-ok check-mark"></span>
                                    </a>
                                </li>
                                </ul>
                            </div>
                            <select class="selectpicker" tabindex="-98">
                                <option>1</option>
                                <option>2</option>
                                <option>5</option>
                            </select>
                        </div>
                        z {{$task_rep_count}} mozliwych
                    </p>
    -->