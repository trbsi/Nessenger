<main>
    <div class="flex flex-wrap overflow-hidden w-full" id="main">
        <div class="overflow-hidden w-full">
            <div class="col" id="outerMessagesScreen">
                <div class="col-content">
                    <section class="message" id="searchMessagesWrapper" style="display: none">
                        <div class="flex mt-50 w-full" id="searchMessagesSpinner">@TODO NEKI SPINNER OVDJE</div>
                        <div class="grid-message w-full" id="searchMessagesGrid" style="display: none">
                        <!-- messages go here -->
                        </div>
                    </section>
                    <section class="message" id="originalMessagesWrapper">
                        <div class="grid-message w-full" id="originalMessagesGrid">
                            <div class="w-full text-center">{{ __('home.messages.showing_last_x_results', ['maxResults' => $maxResults]) }}</div>
                            @foreach($lastMessages as $lastMessages)
                                <div class="col-message-sent">
                                    <div class="message-sent">
                                        <p>{!! $lastMessages['_source']['message'] !!}</p>
                                    </div>
                                </div>
                            @endforeach
                        <!-- messages go here -->
                        </div>
                    </section>
                </div>
                <div class="col-foot" id="composeMessageWrapper">
                    <div class="compose">
                        <textarea placeholder="{{ __('home.type_msg_input') }}" id="typeMessage"
                                  class="w-11/12"></textarea>
                        <div class="compose-dock">
                            <div class="dock"><!-- TODO <img src="./img/picture.svg"> --><img src="./img/send.png"
                                                                                id="sendMessageIcon"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@push('js')
    <script>
        //---------------------SEND MESSAGE---------------------------
        $('#sendMessageIcon').click(function () {
            sendMessage(
                '{{ route('v1.messages.send') }}',
                '{{ __('messages.empty_message') }}',
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
                    '{{ route('v1.messages.send') }}',
                    '{{ __('messages.empty_message') }}',
                    $(this).val()
                );
                return false;
            }
        });

        //----------------------SEARCH MESSAGES-----------------------------
        $('#searchInput').keyup(function (e) {
            //13 = enter
            if ($(this).val().length >= 3 && e.keyCode === 13 && '' !== '{{ auth()->id() }}') {
                searchMessages($(this).val(),  '{{ route('v1.messages.search') }}');
            }
        });

    </script>
@endpush
