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
    /* Ajoute la classe .dropdown-menu */
    $(".sub-menu").addClass("dropdown-menu");
    /** Insère la flèche au debut de chaque liste **/
    $('.widget_recent_entries ul li a').before('<i class="fa fa-angle-right"></i>');
    $('.widget_archive ul li a').before('<i class="fa fa-angle-right"></i>');
    $('.widget_categories ul li a').before('<i class="fa fa-angle-right"></i>');
    $('.widget_meta ul li a').before('<i class="fa fa-angle-right"></i>');
    $('.widget_recent_comments ul li a:first-child').before('<i class="fa fa-angle-right"></i>');

    $('.nav-previous a').addClass('col-md-5 btn btn-lg btn-default');
    $('.nav-next a').addClass('col-md-5 btn btn-lg btn-default');
    $('.nav-links').wrap("<div class='row' />");
    var htmlsearch = $('.search-form label').html();
    console.log(htmlsearch);
    $('.search-form label').replaceWith(htmlsearch);
    //$('.widget').addClass("clearfix");
});

