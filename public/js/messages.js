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
                '<p>'+message+'</p>' +
                '</div>' +
            '</div>';
            console.log(append);
            $(append).appendTo('.grid-message');

            $(".col-content").animate({ scrollTop: $(document).height() }, 1000);
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
    var windowH = $(window).height();
    var headerH = $('#navbar').outerHeight();
    $('#main').height(windowH-headerH);
    $('#outerMessagesScreen').height(windowH-headerH);

    //resize inner messages window
    var composeMessageH = $('.col-foot').height();
    var innerMessagesScreenH = (windowH-headerH-composeMessageH)+'px';
    $('#innerMessagesScreen').css('height', innerMessagesScreenH);
});
