var searchSpinnerIcon = $('#searchSpinnerIcon');
var searchResetIcon = $('#searchResetIcon');
var searchStartIcon = $('#searchStartIcon');
var searchInput = $('#searchInput');
var searchMessagesWrapper = $('#searchMessagesWrapper');
var originalMessagesWrapper = $('#originalMessagesWrapper');
var searchMessagesSpinner = $('#searchMessagesSpinner');
var searchMessagesGrid = $('#searchMessagesGrid');
var searchMessagesNoResults = $('#searchMessagesNoResults');

//----------------------------SEND--------------------------
function sendMessage(
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
            var append = messageHtml(data.message);
            $(append).appendTo('#originalMessagesGrid');

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

//----------------------------SEARCH--------------------------
function searchMessages(keyword, route) {
    originalMessagesWrapper.hide();
    searchMessagesGrid.hide();
    searchMessagesNoResults.hide();
    searchMessagesGrid.empty();
    searchMessagesWrapper.show();
    searchMessagesSpinner.show();

    searchStartIcon.hide();
    searchResetIcon.hide();
    searchSpinnerIcon.show();

    var data = {
        message: keyword
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
            if (data.length === 0) {
                searchMessagesGrid.hide();
                searchMessagesNoResults.show();
            } else  {
                $.each(data, function (key, result) {
                    var append = messageHtml(result.message);
                    $(append).appendTo('#searchMessagesGrid');
                });
                searchMessagesWrapper.mark(keyword);
                searchMessagesGrid.show();
                searchMessagesNoResults.hide();
            }

            scrollMessagesToBottom();
            searchMessagesSpinner.hide();
            searchStartIcon.hide();
            searchResetIcon.show();
            searchSpinnerIcon.hide();

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(errorThrown);
        }
    });
}


//--------------------------------HELPERS-------------------------
function messageHtml(message) {
    message =
    '<div class="col-message-sent">' +
        '<div class="message-sent">' +
            '<p>'+message+'</p>' +
        '</div>' +
    '</div>';

    return message;
}


function scrollMessagesToBottom() {
    $(".col-content").scrollTop(function () {
        return this.scrollHeight;
    });
}

//Reseting search bar
searchResetIcon.click(function () {
    searchInput.val('');
    searchStartIcon.show();
    searchResetIcon.hide();
    searchSpinnerIcon.hide();
    searchMessagesWrapper.hide();
    originalMessagesWrapper.show();
    scrollMessagesToBottom();
});
