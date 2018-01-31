'use strict';

$(document).ready(function() {
    $('#carouselExampleIndicators').on('slid.bs.carousel', function(event) {
        $('#comments-'+event.from).fadeOut(100);
        $('#comments-'+event.to).fadeIn(200);
    });
});
