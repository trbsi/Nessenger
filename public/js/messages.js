var searchSpinner = $('#searchSpinner');
var searchReset = $('#searchReset');
var searchStart = $('#searchStart');
var searchInput = $('#searchInput');
var searchMessagesWrapper = $('#searchMessagesWrapper');
var originalMessagesWrapper = $('#originalMessagesWrapper');
var searchMessagesSpinner = $('#searchMessagesSpinner');
var searchMessagesGrid = $('#searchMessagesGrid');

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
function searchMessages(inputValue, route) {
    originalMessagesWrapper.hide();
    searchMessagesWrapper.show();

    searchStart.hide();
    searchReset.hide();
    searchSpinner.show();

    var data = {
        message: inputValue
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
            $.each(data, function (key, result) {
                var append = messageHtml(result.message);
                $(append).appendTo('#searchMessagesGrid');
            });
            scrollMessagesToBottom();
            searchMessagesSpinner.hide();
            searchMessagesGrid.show();
            searchStart.hide();
            searchReset.show();
            searchSpinner.hide();
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
searchReset.click(function () {
    searchInput.val('');
    searchStart.show();
    searchReset.hide();
    searchSpinner.hide();
    searchMessagesWrapper.hide();
    originalMessagesWrapper.show();
    scrollMessagesToBottom();
});
