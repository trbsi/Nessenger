function updateMessage(
    route,
    emptyMessageError,
    message
) {
    message = message.trim();
    //https://stackoverflow.com/questions/863779/how-to-add-line-breaks-to-an-html-textarea
    message = message.replace(/\r?\n/g, '<br>');
    if (message === '') {
        Swal.fire(
            'Oops',
            emptyMessageError,
            'error'
        );
        return;
    }

    var data = {
        message: message
    };

    $.ajax({
        url : route,
        type: 'POST',
        data : data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data, textStatus, jqXHR)
        {
            var append =
            '<div class="col-message-sent">' +
                '<div class="message-sent">' +
                '<p>'+data.message+'</p>' +
                '</div>' +
            '</div>';

            $(append).appendTo('.grid-message');

            //https://stackoverflow.com/questions/270612/scroll-to-bottom-of-div/26293764
            scrollMessagesToBottom();
            $('textarea#typeMessage').val('');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(errorThrown);
        }
    });
}

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
    var innerMessagesScreenH = (totalHeight-composeMessageH)+'px';
    $('#innerMessagesScreen').css('height', innerMessagesScreenH);

    scrollMessagesToBottom();
});


function scrollMessagesToBottom() {
    $(".col-content").scrollTop(function () {
        return this.scrollHeight;
    });
}
