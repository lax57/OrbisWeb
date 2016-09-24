$("#toggler").on('click', function () {
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
    $("#translation").append("Tłumaczenie");
    $("#translation").fadeIn(500);
    console.log('Costam');
    $("#next").removeClass('btn-inactive');
})

$("#next").on('click', function (event) {
    console.log('Costam');
    $("#translation").hide();
    $("#word").toggle("slide", { direction: "up" }, 500);
    $("#word").toggle("slide", { direction: "left" }, 500);
})


/*var $grid = $('.course-container').isotope({
    itemSelector: '.item',
    animationEngine: 'best-available',
    layoutModel: 'fitRows'
});

SLIDING MENU
item = $(this);
    $("#side-menu").find('.active').find('.sub-menu').slideUp("medium", function () {
        $("#side-menu").find('.active').removeClass('open active');
        item.addClass('open');
        item.addClass('active');

        item.find('.sub-menu').slideDown("medium", function () { });
    });

$('#name-filter button').click(function () {
    var item = $(this);
    $('#name-filter .active').removeClass('active');
    item.addClass('active');

    var filterValue = $(this).attr('data-filter');
    $grid.isotope({ filter: filterValue });
});
*/

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

/*
$(".course-actions li").hover( function () {
    $(".overlay").slideDown("medium", function () {
        
    });
});

$(".course-actions li").mouseout(function () {
    $(".overlay").slideUp("medium", function () {

    });
});*/