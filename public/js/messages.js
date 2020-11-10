function updateMessage(
    route,
    emptyMessageError,
    message
) {
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
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(errorThrown);
        }
    });
}


$(document).ready(function() {
    var windowH = $(window).height();
    var headerH = $('#navbar').outerHeight();
    $('#main').height(windowH-headerH);
    $('#outerMessagesScreen').height(windowH-headerH);

    //resize inner messages window
    var composeMessageH = $('.col-foot').height();
    $('#innerMessagesScreen').css('height', (windowH-headerH-composeMessageH)+'px');
});
