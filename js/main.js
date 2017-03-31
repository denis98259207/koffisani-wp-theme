jQuery(document).ready(function ($) {
    /*============
     BUTTON UP
     * ===========*/
    var btnUp = $('<div/>', {'class':'btntoTop'});
    btnUp.appendTo('body');
    $(document)
        .on('click', '.btntoTop', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 700);
        });

    $(window)
        .on('scroll', function() {
            if ($(this).scrollTop() > 200)
                $('.btntoTop').addClass('active');
            else
                $('.btntoTop').removeClass('active');
        });

    $("body").tooltip({
        selector: '[data-toggle="tooltip"]'
    });

    $(".sub-menu").addClass("dropdown-menu");
    //$("#comment").addClass("form-control");
    //$("#submit").addClass("btn btn-lg btn-default");
    //$("#author, #email, #url").addClass("col-lg-4 col-md-4 form-control").wrap("<div class='col-sm-4'></div>");
});

