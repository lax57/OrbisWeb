<div class="btn-group btn-group-justified excercise-nav">
    <a href="{{ route('lessons_overview', ['course_id'=>$course_id ]) }}" id="finish-excercise" class="btn btn-primary">
        <span>Zakończ</span>
        <i class="fa fa-times-circle-o " aria-hidden="true"></i>
    </a>
    <a id="dontknow" class="btn btn-primary btn-inactive">Nie umiem</a>
    <a id="check" class="btn btn-primary btn-inactive">Sprawdź</a>
    <a id="know" class="btn btn-primary btn-inactive">Umiem</a>
    <a id="next" class="btn btn-primary btn-inactive">
        <span>Dalej</span>
        <i class="fa fa-angle-double-right fa-2" aria-hidden="true"></i>
    </a>
    <a href="javascript:{}" onclick="$('#nextExcerciseForm').submit();" id="nextExcercise" class="btn btn-primary" style="display:none">
        <span>Dalej</span>
        <i class="fa fa-angle-double-right fa-2" aria-hidden="true"></i>
    </a>
</div>
<form action="{{$nextRoute}}" method="post" id="nextExcerciseForm">
    <input type="hidden" value="{{Session::token()}}" name="_token" />
    <input type="hidden" value="{{$course_id}}" name="courseId" />
    <input type="hidden" value="{{$lesson_id}}" name="lessonId" id="lessonId" />
    <input type="hidden" value="{{$excCount}}" name="repNo" />
</form>