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
                <div class="vocabulary-container description-box" >
                    <div class="heading uppercase">
                        Słownictwo - Wprowadzenie
                    </div>
                    <div class="content">
                        <h1 id="word" data-wordid="">
                            
                        </h1>
                        <h1 id="translation" style="display:none"></h1>
                    </div>
                </div>

            </div>
        </div>

        @include('includes.vocabulary.navbuttons', ['nextRoute' => route('vocabulary_listen') ])

    </div>
    <script type="text/javascript">
        var words = <?php echo json_encode($words); ?>;
        var endUrl = '{{ route('lessons_overview', ['course_id'=>$course_id ]) }}';
        var firstWord = words[Math.floor(Math.random() * words.length)];
        var remainingRep = '{{count($words) }}';
        $("#remainingAnswers").text(remainingRep);
        $("#word").text(firstWord['word']);
        $("#word").data('wordid', firstWord['id']);
        $(document).ready(function(){
            $("#finish-excercise")[0].href = endUrl;
            activateButtons(false, true, false, false);
        });


        function validateView(){
            var wordId = $("#word").data("wordid");
            console.log(wordId);
            $.ajax({
                method: 'POST',
                url: fetchWordTranslation,
                data: { wordId: wordId, _token: token }
            })
            .done(function (response) {
                console.log(response);
                console.log(response['translatedWords'][0]['word']);
                $("#translation").text(response['translatedWords'][0]['word']);
                $("#translation").fadeIn(500);
                activateButtons(true, false, true, false);
                return {repNo: 1, repId: 0};
            });
        };

        function acceptView(){
            var word = $("#word").text();
            var wordId = $("#word").data("wordid");
            words = words.filter(function (el) {
                return el.id !== wordId;
            });

            if (words.length > 0) {
                loadNextViewSlide();
            } else {
                $("#next").hide();
                $("#nextExcercise").show();

                activateButtons(false, false, false, false);
            }
        };

        function cancelView(){
            loadNextViewSlide();
        };

        function loadNextViewSlide() {
            var slideValues = ['up', 'down', 'right', 'left'];
            var nextWord = words[Math.floor(Math.random() * words.length)];

            $("#translation").hide();
            $("#word").toggle("slide", { direction: slideValues[Math.floor(Math.random() * slideValues.length)] }, 300, function () {
                $("#word").text(nextWord['word']);
                $("#word").data('wordid', nextWord['id']);
            });
            $("#word").toggle("slide", { direction: slideValues[Math.floor(Math.random() * slideValues.length)] }, 400, function () {
                activateButtons(false, true, false, false);
            });
        }


        $('body').bind('keypress', function(e) {
            var code = e.keyCode || e.which;
             if(code == 13 && !$("#check").hasClass("btn-inactive")) { //Enter keycode
                        $('#check').trigger('click');
             }
        });

    </script> 
</div>
@endsection