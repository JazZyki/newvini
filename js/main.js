/* Function(s) to expand top menu */
(function($) {

    "use strict";

    $('.language').hover(function() {
        var $this = $(this);
        $this.addClass('show');
        $this.find('> a').attr('aria-expanded', true);
        $this.find('.dropdown-menu').addClass('show');
    }, function() {
        var $this = $(this);
        $this.removeClass('show');
        $this.find('> a').attr('aria-expanded', false);
        $this.find('.dropdown-menu').removeClass('show');
    });
    $('nav .dropdown').hover(function() {
        var $this = $(this);
        $this.addClass('show');
        $this.find('> a').attr('aria-expanded', true);
        $this.find('.dropdown-menu').addClass('show');
    }, function() {
        var $this = $(this);
        $this.removeClass('show');
        $this.find('> a').attr('aria-expanded', false);
        $this.find('.dropdown-menu').removeClass('show');
    });

})(jQuery);

/* Function to clickable map work properly */
$(function() {
    var czechMapOverlap = $('#czechMap-overlap');

    // map hover
    $('.czechMap-area').hover(function() {

        czechMapOverlap.attr('src', $(this).attr('data-img'));
        //czechMapOverlap.hide(0).stop(false, true);
        czechMapOverlap.show();

    }, function() {

        czechMapOverlap.attr('src', './img/mapa/none.png');
        czechMapOverlap.show(0);
    });

    $('.czechMap-area, .czechMap-link').click(function(e) {
        e.preventDefault();
        czechMapOverlap.attr('src', $(this).attr('data-img'));

        var area = $(this).attr('data-title');
        $('.map-contacts-title').empty().text(area);
        var officeKey = $(this).attr('data-target');
        //$('.map-contacts-hr').show();

        $('.map-contacts-office').hide();
        $('.' + officeKey).show();
    });
});