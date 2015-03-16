jQuery(document).ready(function ($) {
    $('.track-button').tooltipster();

    $(document).on('mouseover', 'a.track-button', (function (e) {
        $(this).tooltipster('content', $(this).attr('data-title'));
    }));

    if (1 != ywot.p) {
        $(document).on('click', "a.track-button", (function (e) {
            e.preventDefault();

            $(this).tooltipster('content', $(this).attr('data-title'));
        }));
    }

});