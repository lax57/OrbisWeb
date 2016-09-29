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
                        Gramatyka
                    </div>
                    <div class="content">
                        <h1 id="task" data-taskid="" style="font-size:30px"></h1>
                        <input type="text" id="user-input" class="form-control" placeholder="Wpisz odpowiedź" />

                    </div>
                </div>

            </div>
        </div>

        @include('includes.vocabulary.navbuttons', ['nextRoute' => route('lessons_overview', ['course_id'=>$course_id ])])

    </div>
    
    <script type="text/javascript">
        var task_rep_count = [];
        var course_id = {{$course_id}};
        var tasks = <?php echo json_encode($tasks); ?>;
        var repetitions = <?php echo json_encode($repetitions); ?>;
        var endUrl = '{{ route('lessons_overview', ['course_id'=>$course_id ]) }}';
        var firstTask = tasks[Math.floor(Math.random() * tasks.length)];
        var firstTaskId = firstTask['id'];
        var remainingRep = '{{ count($tasks) }}';
        $("#remainingAnswers").text(remainingRep);
        $("#task").data('taskid', firstTaskId);
        $("#task").text(firstTask['task']);
        $(document).ready(function(){
            activateButtons(false, true, false, false);
        });

        function validateView(){
            var taskId = $("#task").data("taskid");
            var userInput = $('.content .form-control')[0].value;
            var expectedAnswer = tasks.filter(function( task ) {
                return task.id == taskId;
            })[0];

            if(task_rep_count[taskId] == null) task_rep_count[taskId] = 1;
            else task_rep_count[taskId] +=1;

            if(userInput === expectedAnswer['answer']){
                $('.content .form-control').addClass('success');
                tasks = tasks.filter(function (el) {
                    return el.id !== taskId;
                });


                var lastRepetitionId =-1;
                if(repetitions != null) {
                    var lastRepetitionId = repetitions.filter(function( r ) {

                        if(r.excercise_id == taskId) return r;
                    })[0]['id'];
                }


                activateButtons(false, false, false, true);
                return {repNo: task_rep_count[taskId], repId:lastRepetitionId, type: 'App\\Task', courseId: course_id, excerciseId: taskId  };
            }else{
                $('.content .form-control').addClass('fail');
                activateButtons(false, false, false, true);
                return {repNo: -1 };
            }
        };

        function loadNextViewSlide() {
            if (tasks.length > 0) {
                var slideValues = ['up', 'down', 'right', 'left'];
                var nextTask = tasks[Math.floor(Math.random() * tasks.length)];
                var nextTaskId = nextTask['id'];
                $("#task").data('taskid', nextTaskId);
                $('.content .form-control').removeClass('success');
                $('.content .form-control').removeClass('fail');

                $("#task").toggle("slide", { direction: slideValues[Math.floor(Math.random() * slideValues.length)] }, 300, function () {
                    $("#task").text(nextTask['task']);
                });
                $("#task").toggle("slide", { direction: slideValues[Math.floor(Math.random() * slideValues.length)] }, 400, function () {
                    activateButtons(false, true, false, false);
                });
            } else {
                var nextButtonLink = $("#next");
                nextButtonLink[0].href = endUrl;
                activateButtons(false, false, false, true);
            }
        }

        function endExcercise(){
            var endExcerciseButtonLink = $("#finish-excercise");
            endExcerciseButtonLink[0].href = endUrl;
        }

        $('body').bind('keypress', function(e) {
            var code = e.keyCode || e.which;
            if(code == 13 && !$("#check").hasClass("btn-inactive")) { //Enter keycode
                $("#user-input").blur();
                $('#check').trigger('click');
            }else{
                if(code == 13 && $("#check").hasClass("btn-inactive") && !$("#next").hasClass("btn-inactive"))
                    $('#next').trigger('click');
            }
        });


    </script>
    

</div>
@endsection

