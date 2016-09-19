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
})