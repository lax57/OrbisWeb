@extends('layouts.dashboard')

@section('page-content')
<div class="page-content-wrapper">
    <div id="page-content" class="page-content" style="min-height:509px">

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
            
                <ol class="carousel-indicators">
                    @foreach($lessons as $key => $lesson)
                    <li data-target="#carousel-example-generic" data-slide-to="{{$key}}" class="@if($key == 0) active @endif"></li>
                    @endforeach
                </ol>
            
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                @foreach($lessons as $key => $lesson)
                <div class="item @if($key == 0) active @endif" data-lessonno="{{$key+1}}" data-lessonid="{{$lesson->id}}">
                    <div class="lesson-title-page">
                        <h1>Lekcja {{$key+1}}</h1>
                    </div>
                    <div class="description-container">
                        <div class="description-box" style="height:100%">
                            <div class="heading uppercase">
                                {{$lesson->title}}
                            </div>
                            <div class="content">
                                <p>{{    $lesson->description}}</p>
                            </div>
                            <div class="actions">
                                <ul class="list-inline">
                                    <li style="margin-right:10px;">
                                        <a href="{{route('lesson_pdf', ['file_name'=> $lesson->pdf_file])}}">
                                            <i class="fa fa-file-pdf-o fa-4x" aria-hidden="true"></i>
                                            <p>{{trans('lessons_overview.PDF') }}</p>
                                        </a>
                                    </li>
                                    <li data-wordsno="{{$lessons_remeining_excercises[$key]['word_remaining']}}">
                                        <a href="{{    route('vocabulary_intro', ['course_id' => $lesson->course, 'lesson_id' => $lesson->id ])}}"></a>
                                        <i class="fa fa-book fa-4x" aria-hidden="true"></i>
                                        <p>{{trans('lessons_overview.vocabulary') }}</p>
                                    </li>
                                    <li data-taskno="{{$lessons_remeining_excercises[$key]['task_remaining']}}">
                                        <a href="{{    route('grammar_task', ['course_id' => $lesson->course, 'lesson_id' => $lesson->id ])}}"></a>
                                        <i class="fa fa-language fa-4x" aria-hidden="true"></i>
                                        <p>{{trans('lessons_overview.grammar') }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
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

    <div class="modal fade" tabindex="-1" role="dialog" id="new-word-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{trans('modal.title') }}</h4>
                </div>
                <form action="{{route('vocabulary_intro')}} " method="post">
                    <div class="modal-body">

                        <p id="selectWordRepCount">
                            <select class="selectpicker" name="repNo">
                                <option>1</option>
                                <option>10</option>
                                <option>20</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                            <input type="hidden" value="{{Session::token()}}" name="_token" />
                            <input type="hidden" value="{{$lessons[0]->course_id}}" name="courseId" />
                            <input type="hidden" value="aa" name="lessonId" id="lessonId" />
                            <span>z <span id="numberOfWordReps"></span> mozliwych jednostek</span>
                        </p>
                        <p id="noWordReps">
                            <span>{{trans('lessons_overview.lesson_complete') }}</span>
                        </p>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('modal.close') }}</button>
                            <button type="submit" class="btn btn-primary" id="goto-word-reps">{{trans('modal.go') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>

        </script>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="new-grammar-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{trans('modal.title') }}</h4>
                </div>
                <form action="{{route('grammar_task')}} " method="post">
                    <div class="modal-body">

                        <p id="selectTaskRepCount">
                            <select class="selectpicker" name="repNo">
                                <option>1</option>
                                <option>10</option>
                                <option>20</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                            <input type="hidden" value="{{Session::token()}}" name="_token" />
                            <input type="hidden" value="{{$lessons[0]->course_id}}" name="courseId" />
                            <input type="hidden" value="" name="lessonId" id="lessonId" />
                            <span>z <span id="numberOfTaskReps"></span> mozliwych jednostek</span>
                        </p>
                        <p id="noTaskReps">
                            <span>{{trans('lessons_overview.lesson_complete') }}</span>
                        </p>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('modal.close') }}</button>
                            <button type="submit" class="btn btn-primary" id="goto-task-reps">{{trans('modal.go') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>

        </script>
    </div>

    <script type="text/javascript">
    </script>

</div>
@endsection

