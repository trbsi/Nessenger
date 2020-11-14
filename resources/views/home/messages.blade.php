<main>
    <div class="flex flex-wrap overflow-hidden w-full" id="main">
        <div class="overflow-hidden w-full">
            <div class="col" id="outerMessagesScreen">
                <div class="col-content">
                    <section class="message" id="searchMessagesWrapper" style="display: none">
                        <div class="flex my-32 w-full justify-center" id="searchMessagesSpinner">
                            <div class="lds-dual-ring"></div>
                        </div>
                        <div class="mt-50 w-full text-center" id="searchMessagesNoResults" style="display:none;">{{ __('home.messages.no_results') }}</div>
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
