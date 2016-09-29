﻿$("#toggler").on('click', function () {
    var body = $("body");
    var logo = $("#orbis-logo");
    var sidebar=$(".page-sidebar"),
    sidebarMenu=$(".page-sidebar-menu");
    $(".sidebar-search", sidebar).removeClass("open"),
    body.hasClass("page-sidebar-closed")?(body.removeClass("page-sidebar-closed"),
    sidebarMenu.removeClass("page-sidebar-menu-closed"),
    $.cookie&&$.cookie("sidebar_closed","0")):(body.addClass("page-sidebar-closed"),
    sidebarMenu.addClass("page-sidebar-menu-closed"),
    body.hasClass("page-sidebar-fixed")&&sidebarMenu.trigger("mouseleave"),
    $.cookie && $.cookie("sidebar_closed", "1")), $(window).trigger("resize");
    if (logo.is(":visible")) logo.hide(); else logo.show();
    $grid.isotope('layout');
})

$("#side-menu").find(".nav-button-dropdown").on('click', function () {
    clickedButton = $(this);
    if ($("#side-menu").find(".open")[0]) {
        if (!clickedButton.hasClass("active")) {
            $("#side-menu").find('.active').find('.sub-menu').slideUp("medium", function () {
                $("#side-menu").find('.arrow').removeClass('open');
                $("#side-menu").find('.active').removeClass('open active');

                clickedButton.addClass('open active');
                clickedButton.find('.arrow').addClass('open');

                clickedButton.find('.sub-menu').slideDown("medium", function () { });
            });
        } else {
            $("#side-menu").find('.active').find('.sub-menu').slideUp("medium", function () {
                $("#side-menu").find('.arrow').removeClass('open');
                clickedButton.removeClass('open active');
            });
        }
    } else {
        clickedButton.addClass('open active');
        clickedButton.find('.arrow').addClass('open');
        $("#side-menu").find('.active').find('.sub-menu').slideDown("medium", function () {});
    }
});

$(".course-actions").find('li').eq(1).find('a').on('click', function () {
    $("#grammar-modal").modal();
})

$(".course-actions").find('li').eq(2).find('a').on('click', function () {
    $("#word-modal").modal();
})

$(".actions li:nth-child(2)").click(function (event) {
    lessonId = event.target.closest('.actions').parentNode.parentNode.parentNode.dataset['lessonno'];
    wordsno = event.target.closest('li').dataset['wordsno'];
    if (wordsno > 0) {
        $("#noWordReps").hide();
        $("#selectWordRepCount").show();
        $("#new-word-modal #lessonId").val(lessonId);
        $("#numberOfWordReps").text(wordsno);
        $("#goto-word-reps").show();

    } else {
        console.log(wordsno);
        $("#selectWordRepCount").hide();
        $("#goto-word-reps").hide();
        $("#noWordReps").show();
    }
    $("#new-word-modal").modal();
})

$(".actions li:nth-child(3)").click(function (event) {
    lessonId = event.target.closest('.actions').parentNode.parentNode.parentNode.dataset['lessonno'];
    console.log(lessonId);
    tasksno = event.target.closest('li').dataset['taskno'];
    if (tasksno > 0) {
        $("#noTaskReps").hide();
        $("#selectTaskRepCount").show();
        $("#new-grammar-modal #lessonId").val(lessonId);
        $("#numberOfTaskReps").text(tasksno);
        $("#goto-task-reps").show();

    } else {
        $("#selectTaskRepCount").hide();
        $("#goto-task-reps").hide();
        $("#noTaskReps").show();
    }
    $("#new-grammar-modal").modal();
})



$(".course-sign-up").on('click', function (event) {
    button = $(this);
    button.addClass("btn-inactive");
    var courseId = event.target.parentNode.dataset['courseid'];
    $.ajax({
        method: 'POST',
        url: courseSignUpUrl,
        data: { courseId: courseId, _token: token }
    })
    .done(function (msg) {
        button.parent().find('.course-name').animate({
        top: 0,
    }, 300, function () {
            button.parent().find('.course-success').show();
            button.parent().find('#successful-course-signup').show();
    });
    });
})

$("#leave-course").on('click', function (event) {
    console.log("AAAAAA");
    button = $(this);
    var courseId = event.target.parentNode.dataset['courseid'];
    $.ajax({
        method: 'POST',
        url: courseSignOutUrl,
        data: { courseId: courseId, _token: token }
    })
    .done(function (response) {
        window.location.href = response['url'];
    });
    })


$("#check").on('click', function (event) {

    var check = validateView();

    if(check['repNo'] > 0) {
        updateStats(-1, 1, 0);
        if (check['repId'] === -1) { setNewRepetition(check['repNo'], check['excerciseId'], check['type'], check['courseId']) }
    else {
            if (check['repId'] > 0) {
                updateRepetition(check['repId'], check['repNo']);
    } else {
                console.log("Nie rób nic");
    }
    }
    } else{
        if(check['repNo'] === -1) {
            updateStats(0, 0, 1);
            console.log("Nie wyznaczaj powtorki");
    }
    } 

    });

$("#next").on('click', function (event) {
    loadNextViewSlide();
    updateStatsDate('');
    })

$("#know").on('click', function (event) {
        //TODO Ajax for repetition!!
    updateStats(-1, 1, 0);
    acceptView();

    })

$("#dontknow").on('click', function (event) {
    updateStats(0, 0, 1);
    cancelView();
    })

function setNewRepetition(userInputTrys, excerciseId, type, courseId) {
    console.log('Ustawiam nowa powtorke');
    $.ajax({
        method: 'POST',
        url: setRepetitionUrl,
        data: { userInputTrys: userInputTrys, excerciseId:excerciseId, type:type, courseId:courseId, _token: token }
    })
    .done(function (response) {
        console.log("Powtorka ustawiona!!!");
        updateStatsDate(response['next_repetition']);
        return 0;
    });
    }

function updateRepetition(repId, userTrys) {
    $.ajax({
        method: 'POST',
        url: updateRepetitionUrl,
        data: { repId: repId, userInputTrys: userTrys, _token: token }
    })
    .done(function (response) {
        console.log("Powtorka updateowana na:!!!");
        updateStatsDate(response['next_repetition']);
        return 0;
    });
    }

function updateStats(left, good, bad) {
    var remaining = parseInt($("#remainingAnswers").text());
    remaining += left;
    $("#remainingAnswers").text(remaining);

    var goodAnswers = parseInt($("#goodAnswers").text());
    goodAnswers += good;
    $("#goodAnswers").text(goodAnswers);

    var badAnswers = parseInt($("#badAnswers").text());
    badAnswers += bad;
    $("#badAnswers").text(badAnswers);

    var progress = ((goodAnswers/(goodAnswers + badAnswers))*100).toFixed(2);
    $("#progress-bar").width(progress+'%');
    $("#progress-bar").find('h3').text(progress + '%');
    }

function updateStatsDate(date) {
    $("#nextRepDate").text(date);
    }


function activateButtons(dontknow, check, know, next) {
    if (dontknow){ $("#dontknow").removeClass('btn-inactive')} else $("#dontknow").addClass('btn-inactive');
    if (check) { $("#check").removeClass('btn-inactive') } else $("#check").addClass('btn-inactive');
    if (know) { $("#know").removeClass('btn-inactive') } else $("#know").addClass('btn-inactive');
    if (next) { $("#next").removeClass('btn-inactive') } else $("#next").addClass('btn-inactive');
    }


var $grid = $('.course-container').isotope({
        itemSelector: '.item',
        animationEngine: 'best-available',
        layoutModel: 'fitRows',
    });

var filters = {};

$('.course-filter').on('click', 'button', function () {
    var $this = $(this);
        // get group key
    var $buttonGroup = $this.parents('.course-filter');
    var filterGroup = $buttonGroup.attr('data-filter-group');
        // set filter for group
    filters[filterGroup] = $this.attr('data-filter');
        // combine filters
    var filterValue = concatValues(filters);
        // set filter for Isotope
    $grid.isotope({ filter: filterValue });
    });

        // change is-checked class on buttons
$('.course-filter').each(function (i, buttonGroup) {
    var $buttonGroup = $(buttonGroup);
    $buttonGroup.on('click', 'button', function () {
        $buttonGroup.find('.active').removeClass('active');
        $(this).addClass('active');
    });
    });

        // flatten object by concatting values
function concatValues(obj) {
    var value = '';
    for (var prop in obj) {
        value += obj[prop];
    }
    return value;
    }
