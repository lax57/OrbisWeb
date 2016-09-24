<div class="course-container">
    @foreach($courses as $course)
    <div class="item medium-course-box-wrapper lang_{{$course->language}} {{$course->level}} ">
        <div class="course-box" data-courseid="{{$course->id}}">
            <div class="image-container">
                <img src="{{URL::asset('img/small-'.$course->img_file)}}" alt="" title="" />
                <div class="course-name" id="open-name">
                    <span class="uppercase">{{$course->name}} {{$course->level}}</span>

                    <div class="course-code-input" style="display:none">
                        <ul class="list-inline">
                            <li>
                                <input type="text" class="form-control" placeholder="Podaj kod dostępu" />
                            </li>
                            <li>
                                <button id="applyCode" class="btn btn-accept" type="submit">
                                    OK
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="course-success" >{{trans('course_box.successful_signup')}}</div>
                    <a href="{{route('course_page', ['course_id' => $course->id])}}" id="successful-course-signup" style="display:none" class="btn btn-accept" type="submit">
                        {{trans('course_box.go')}}
                    </a>
                </div>
            </div>

            @if(Auth::User()->courses()->where('course_id', $course->id)->first())
            <a href="{{route('course_page', ['course_id' => $course->id])}}" class="btn btn-default btn-transparent-red course-go-in">
                {{trans('course_box.go_to_course')}}
            </a>
            @else
            <a class="btn btn-default btn-transparent-red course-sign-up">
                {{trans('course_box.sign_up')}}
            </a>
            @endif
        </div>
    </div>
    @endforeach
</div>