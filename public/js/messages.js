var searchSpinnerIcon = $('#searchSpinnerIcon');
var searchResetIcon = $('#searchResetIcon');
var searchStartIcon = $('#searchStartIcon');
var searchInput = $('#searchInput');
var searchMessagesWrapper = $('#searchMessagesWrapper');
var latestMessagesWrapper = $('#latestMessagesWrapper');
var searchMessagesSpinner = $('#searchMessagesSpinner');
var searchMessagesGrid = $('#searchMessagesGrid');
var searchMessagesNoResults = $('#searchMessagesNoResults');
var minSearchChars = 3;

//----------------------------SEND--------------------------
$('#sendMessageIcon').click(function () {
    sendMessage(
        sendMessageRoute,
        emptyMessageTranslation,
        $("#typeMessage").val()
);

});

//CTRL + ENTER for new line
//https://stackoverflow.com/questions/8187512/textarea-control-custom-behavior-enter-ctrlenter
$('textarea#typeMessage').keydown(function (e) {
    if ((e.keyCode === 13 && e.ctrlKey) || (e.keyCode === 13 && e.shiftKey)) {
        $(this).val(function (i, val) {
            return val + "";
        });
    }
}).keypress(function (e) {
    //13 = enter
    if (e.keyCode === 13 && (!e.ctrlKey && !e.shiftKey)) {
        sendMessage(
            sendMessageRoute,
            emptyMessageTranslation,
            $(this).val()
    );
        return false;
    }
});

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
            $('textarea#typeMessage').val('');
            searchMessagesWrapper.hide();
            latestMessagesWrapper.show();
            scrollMessagesToBottom();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(errorThrown);
        }
    });
}

//----------------------------SEARCH--------------------------
$('#searchStartIcon').click(function () {
    var term = searchInput.val();
    if (term.length >= minSearchChars && '' !== userId) {
        searchMessages(term,  searchMessageRoute);
    }
});

$('#searchResetIcon').click(function () {
    resetSearch();
});

searchInput.keyup(function (e) {
    var term = $(this).val();
    if (term.length >= minSearchChars && e.keyCode === 13 && '' !== userId) { //13 = enter
        searchMessages(term,  searchMessageRoute);
    } else if ((e.keyCode === 8 || e.keyCode === 46) && term === '') { //backspace and delete
        resetSearch();
    }
});

function resetSearch() {
    searchMessagesWrapper.hide();
    latestMessagesWrapper.show();
    searchResetIcon.hide();
    searchStartIcon.show();
    scrollMessagesToBottom();
}

function searchMessages(keyword, route) {
    latestMessagesWrapper.hide();
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
                searchMessagesGrid.mark(keyword);
                searchMessagesGrid.show();
                searchMessagesNoResults.hide();
            }

            searchMessagesSpinner.hide();
            searchStartIcon.hide();
            searchSpinnerIcon.hide();
            searchResetIcon.show();
            scrollMessagesToBottom();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(errorThrown);
        }
    });
}


//---------------------------DELETE-------------------------------
function deleteAllMessages(element) {
    Swal.fire({
        title: areYouSureTranslation,
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            Swal.fire('Saved!', '', 'success');
            $.ajax({
                url : deleteAllByUserRoute,
                type: 'POST',
                data : {},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data, textStatus, jqXHR)
                {

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    console.log(errorThrown);
                }
            });
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
    latestMessagesWrapper.show();
    scrollMessagesToBottom();
});
