@extends('layouts.dashboard')

@section('page-content')
<div class="page-content-wrapper">
    <div id="vocabulary-page" class="page-content" style="min-height:509px">
        <div class="page-title uppercase">
            @include('includes.vocabulary.progressbar')
        </div>
        <div class="flex-row row ">
            <div class="col-md-3">
                @include('includes.vocabulary.stat',['remaining'=> count($words)])
            </div>
            <div class="col-md-9">
                <div class="vocabulary-container description-box">
                    <div class="heading uppercase">
                        Słownictwo - Wysłuchaj i zapisz
                    </div>
                    <div class="content">
                        <h1><i class="fa fa-volume-up" id="hearicon" aria-hidden="true" data-wordid=""></i> <span></span></h1>
                        <input type="text" class="form-control" placeholder="Wpisz słowo" id="userInputField">
                    </div>
                </div>

            </div>
        </div>

        @include('includes.vocabulary.navbuttons', ['nextRoute' => route('vocabulary_translate')])

    </div>
    <script type="text/javascript">
        var words = <?php echo json_encode($words); ?>;
        var endUrl = '{{ route('lessons_overview', ['course_id'=>$course_id ]) }}';
        var firstWord = words[Math.floor(Math.random() * words.length)];
        var remainingRep = '{{ count($words) }}';
        $("#remainingAnswers").text(remainingRep);
        $(".content h1 span").text(firstWord['word']);
        $("#hearicon").data('wordid', firstWord['id']);
        $(document).ready(function(){
            $("#finish-excercise")[0].href = endUrl;
            activateButtons(false, true, false, false);
        });


        function validateView(){
            var wordId = $("#hearicon").data("wordid");
            var userInput = $('.content .form-control')[0].value;
            var expectedWord = words.filter(function( word ) {
                return word.id == wordId;
            })[0];
                    console.log(expectedWord);
            if(userInput === expectedWord['word']){
                $('.content .form-control').addClass('success');
                words = words.filter(function (el) {
                    return el.id !== wordId;
                });
                if(words.length<1) {
                    $("#next").hide();
                    $("#nextExcercise").show();
                 }
                activateButtons(false, false, false, true);
                return {repNo: 1, repId: 0};
            }else{
                $('.content .form-control').addClass('fail');
                activateButtons(false, false, false, true);
                return {repNo: -1 };
            }
        };

        function loadNextViewSlide() {
            console.log("IT IS LISTEN");
            if (words.length > 0) {
            var slideValues = ['up', 'down', 'right', 'left'];
            var nextWord = words[Math.floor(Math.random() * words.length)];

            $('.content .form-control').removeClass('success');
            $('.content .form-control').removeClass('fail');
            $(".content h1 span").text(nextWord['word']);
            //$("#hearicon").toggle("slide", { direction: slideValues[Math.floor(Math.random() * slideValues.length)] }, 300, function () {
                $("#hearicon").data('wordid', nextWord['id']);
            //});
            //$("#hearicon").toggle("slide", { direction: slideValues[Math.floor(Math.random() * slideValues.length)] }, 400, function () {
                activateButtons(false, true, false, false);
            //});
            } else {
                activateButtons(false, false, false, false);
            }
        }

        function endExcercise(){
                var endExcerciseButtonLink = $("#finish-excercise");
                endExcerciseButtonLink[0].href = endUrl;
                $('#finish-excercise').trigger('click');
        }

        $('body').bind('keypress', function(e) {
            var code = e.keyCode || e.which;
             if(code == 13 && !$("#check").hasClass("btn-inactive")) { //Enter keycode

                        $("#userInputField").blur();
                        $('#check').trigger('click');
             }else{
                if(code == 13 && $("#check").hasClass("btn-inactive") && !$("#next").hasClass("btn-inactive"))
                                $('#next').trigger('click');
                }

        });


    </script>
</div>
@endsection