<main>
    <div class="flex flex-wrap overflow-hidden w-full"  id="main">
        <div class="overflow-hidden w-full">
            <div class="col" id="outerMessagesScreen">
                <div class="col-content">
                    <section class="message" id="innerMessagesScreen">
                        <div class="grid-message w-full">
                            <!-- messages go here -->
                        </div>
                    </section>
                </div>
                <div class="col-foot" id="composeMessageWrapper">
                    <div class="compose">
                        <textarea placeholder="{{ __('home.type_msg_input') }}" id="typeMessage" class="w-11/12"></textarea>
                        <div class="compose-dock">
                            <div class="dock"><img src="./img/picture.svg"><img src="./img/send.png" id="sendMessageIcon"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@push('js')
    <script>
        $('#sendMessageIcon').click(function () {
            updateMessage(
                '{{ route('v1.messages.send') }}',
                '{{ __('messages.empty_message') }}',
                $("#typeMessage").val()
            );

        });

        //CTRL + ENTER for new line
        //https://stackoverflow.com/questions/8187512/textarea-control-custom-behavior-enter-ctrlenter
        $('textarea#typeMessage').keydown(function (e) {
            if ((e.keyCode === 13 && e.ctrlKey) || (e.keyCode === 13 && e.shiftKey)) {
                $(this).val(function(i,val) {
                    return val + "";
                });
            }
        }).keypress(function(e){
            if (e.keyCode === 13 && (!e.ctrlKey && !e.shiftKey)) {
                updateMessage(
                    '{{ route('v1.messages.send') }}',
                    '{{ __('messages.empty_message') }}',
                    $(this).val()
                );
                return false;
            }
        });

    </script>
@endpush
