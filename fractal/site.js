function w() {
    $('li').each(function(i, e) {
        var outerWidth = $(e).width();
        $(e).css('width', outerWidth+'px');
    });
}

$(document).ready(function() {

    w();

});
