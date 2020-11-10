<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
    @livewireStyles
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
<div class="wrapper">
    @include('home.navbar')
    <main>
        <div class="flex flex-wrap overflow-hidden"  id="main">

            <div class="sm:w-1/2 md:w-1/3 lg:w-3/4 xl:w-3/4 overflow-hidden">
                <div class="col" id="messages">
                    <div class="col-content">
                        <section class="message">
                            <div class="grid-message">
                                <div class="col-message-received">
                                    <div class="message-received">
                                        <p>Ok.</p>
                                    </div>
                                    <div class="message-received">
                                        <p>Do you play EVE Online?</p>
                                    </div>
                                </div>
                                <div class="col-message-sent">
                                    <div class="message-sent">
                                        <p>Not anymore.</p>
                                    </div>
                                </div>
                                <div class="col-message-received">
                                    <div class="message-received">
                                        <p>But, can you?</p>
                                    </div>
                                </div>
                                <div class="col-message-sent">
                                    <div class="message-sent">
                                        <p>I guess if I had some practice I could again. It's been years.</p>
                                    </div>
                                </div>
                                <div class="col-message-received">
                                    <div class="message-received">
                                        <p>Dat titan though...</p>
                                    </div>
                                </div>
                                <div class="col-message-sent">
                                    <div class="message-sent">
                                        <p>Trombone, guitar, titan?</p>
                                    </div>
                                </div>
                                <div class="col-message-received">
                                    <div class="message-received">
                                        <p>Niiiiice.</p>
                                    </div>
                                </div>
                                <div class="col-message-sent">
                                    <div class="message-sent">
                                        <div class="">
                                            <p>Do you care if I use the last few minutes of our conversation as dummy text for
                                                this thing I'm coding?
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-message-received">
                                    <div class="message-received">
                                        <p>Sure go ahead.</p>
                                    </div>
                                </div>
                                <div class="col-message-sent">
                                    <div class="message-sent">
                                        <p>Okay.</p>
                                    </div>
                                    <div class="message-sent">
                                        <p>I'll send you some ISK when I'm done.</p>
                                    </div>
                                    <div class="message-sent">
                                        <p>It's cool.</p>
                                    </div>
                                </div>
                                <div class="col-message-received">
                                    <div class="message-received">
                                        <p>Ok.</p>
                                    </div>
                                    <div class="message-received">
                                        <p>Do you play EVE Online?</p>
                                    </div>
                                </div>
                                <div class="col-message-sent">
                                    <div class="message-sent">
                                        <p>Not anymore.</p>
                                    </div>
                                </div>
                                <div class="col-message-received">
                                    <div class="message-received">
                                        <p>But, can you?</p>
                                    </div>
                                </div>
                                <div class="col-message-sent">
                                    <div class="message-sent">
                                        <p>I guess if I had some practice I could again. It's been years.</p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-foot">
                        <div class="compose">
                            <input placeholder="Type a message">
                            <div class="compose-dock">
                                <div class="dock"><img src="./img/picture.svg"><img src="./img/send.png"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sm:w-1/2 md:w-1/3 lg:w-3/12 xl:w-3/12 overflow-hidden">
                <div class="col-right">
                    <div class="col-content">
                        <div class="user-panel">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-5 h-16" id="username" type="text" placeholder="{{__('home.search_term')}}">
                            <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded w-full">
                                {{__('home.search_btn')}}
                            </button>
                        </div>
                    </div>
                    <div class="col-content">
                        <div class="user-panel">
                            <div class="inline-flex w-full">
                                <a class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l w-2/4 text-center" href="{{route('login')}}">
                                    {{__('home.login')}}
                                </a>
                                <a class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r w-2/4 text-center" href="{{route('register')}}">
                                    {{__('home.register')}}
                                </a>
                            </div>

                            <div class="mt-5">
                                <a class="bg-white w-full flex text-center justify-center hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                    {{__('home.login_as_test_user')}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-content">
                        <div class="user-panel">
                            <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                                <p class="font-bold">{{__('home.help_header')}}</p>
                            </div>
                            <ul id="help-links">
                                <li><a class="link" href="mailto:{{config('app.contact_mail')}}">{{__('home.contact_me')}}</a></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

        </div>


    </main>
</div>
@livewireScripts
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<script>
    $(document).ready(function() {
        var windowsH = $(window).innerHeight();
        var headerH = $('header').height();
        $('#main').height(windowsH-headerH);
        $('#messages').height(windowsH-headerH);
    });
</script>
</body>
</html>
