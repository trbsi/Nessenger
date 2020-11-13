//ADJUST SOME HEIGHTS
$(document).ready(function() {
    //resize outer message screen, messages + compose area
    var windowH = $(window).height();
    var headerH = $('#navbar').outerHeight();
    var customAlertH = $('.custom-alert').outerHeight();
    if (customAlertH === undefined) {
        customAlertH = 0;
    }
    var totalHeight = windowH-headerH-customAlertH;
    $('#outerMessagesScreen').height(totalHeight);

    //resize inner messages window
    var composeMessageH = $('.col-foot').height();
    var originalMessagesWrapperH = (totalHeight-composeMessageH)+'px';
    $('section.message').css('height', originalMessagesWrapperH);

    scrollMessagesToBottom();
});
