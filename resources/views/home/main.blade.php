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
                <div class="col-foot">
                    <div class="compose">
                        <input placeholder="{{ __('home.type_msg_input') }}" id="typeMessage">
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
        $("#typeMessage").on('keyup', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                updateMessage(
                    '{{ route('v1.messages.send') }}',
                    '{{ __('messages.empty_message') }}',
                    $(this).val()
                );

            }
        });

        $('#sendMessageIcon').click(function () {
            updateMessage(
                '{{ route('v1.messages.send') }}',
                '{{ __('messages.empty_message') }}',
                $("#typeMessage").val()
            );

        });

    </script>
@endpush
