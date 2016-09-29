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
                        <h1 id="word" data-wordid=""></h1>
                        <input type="text" id="translation-input" class="form-control" placeholder="Wpisz słowo" />

                    </div>
                </div>

            </div>
        </div>

        @include('includes.vocabulary.navbuttons', ['nextRoute' => route('lessons_overview', ['course_id'=>$course_id ])])

    </div>

    <script type="text/javascript">
        //TODO: zamienic course_id w route
        var word_rep_count = [];

        var course_id = {{$course_id}};
        var words = <?php echo json_encode($words); ?>;
        var repetitions = <?php echo json_encode($repetitions); ?>;
        var endUrl = '{{ route('lessons_overview', ['course_id'=>$course_id ]) }}';
        var firstWord = words[Math.floor(Math.random() * words.length)];
        var firstWordId = firstWord['id'];
        var remainingRep = '{{ count($words) }}';
        $("#remainingAnswers").text(remainingRep);
        $("#word").data('wordid', firstWordId);
        $(document).ready(function(){
            $("#finish-excercise")[0].href = endUrl;
            activateButtons(false, true, false, false);
            $.ajax({
                method: 'POST',
                url: fetchWordTranslation,
                data: { wordId: firstWordId, _token: token }
            })
            .done(function (response) {
                $("#word").text(response['translatedWords'][0]['word']);
                return 0;
            });
        });

        function validateView(){
            var wordId = $("#word").data("wordid");
            var userInput = $('.content .form-control')[0].value;
            var expectedWord = words.filter(function( word ) {
                return word.id == wordId;
            })[0];

            if(word_rep_count[expectedWord['id']] == null) word_rep_count[expectedWord['id']] = 1;
            else word_rep_count[expectedWord['id']] +=1;
            

            if(userInput === expectedWord['word']){
                $('.content .form-control').addClass('success');
                words = words.filter(function (el) {
                    return el.id !== wordId;
                });
               
                var wordRepID = -1;
                if(repetitions != null) {
                    var wordRepID = repetitions.filter(function( r ) {
                        
                        if(r.excercise_id == wordId) return r;
                    })[0]['id'];
                    console.log(wordRepID);
                }


                activateButtons(false, false, false, true);
                return {repNo: word_rep_count[expectedWord['id']], repId: wordRepID, type: 'App\\Word', courseId: course_id, excerciseId: wordId  };
            }else{
                $('.content .form-control').addClass('fail');
                activateButtons(false, false, false, true);
                return {repNo: -1 };
            }
        };

        function loadNextViewSlide() {
            if (words.length > 0) {
                var slideValues = ['up', 'down', 'right', 'left'];
                var nextWord = words[Math.floor(Math.random() * words.length)];
                var nextWordId = nextWord['id'];
                $("#word").data('wordid', nextWordId);
                $('.content .form-control').removeClass('success');
                $('.content .form-control').removeClass('fail');

                $("#word").toggle("slide", { direction: slideValues[Math.floor(Math.random() * slideValues.length)] }, 300, function () {
                    $.ajax({
                        method: 'POST',
                        url: fetchWordTranslation,
                        data: { wordId: nextWordId, _token: token }
                    })
                    .done(function (response) {
                        $("#word").text(response['translatedWords'][0]['word']);
                        return 0;
                    });
                });
                $("#word").toggle("slide", { direction: slideValues[Math.floor(Math.random() * slideValues.length)] }, 400, function () {
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

                        $("#translation-input").blur();
                        $('#check').trigger('click');
             }else{
                if(code == 13 && $("#check").hasClass("btn-inactive") && !$("#next").hasClass("btn-inactive"))
                                $('#next').trigger('click');
                }
        });



    </script>
</div>
@endsection