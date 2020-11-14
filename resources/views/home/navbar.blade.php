<div class="w-full flex flex-row items-center p-1 justify-between bg-white shadow-xs" id="navbar">
    <div class="ml-8 text-lg text-gray-700 hidden md:flex"><a href="/"><img src="/img/logo.png" class="logo">{{ env('APP_NAME') }}</a></div>
    <span class="w-screen md:w-1/3 h-10 bg-gray-200 cursor-pointer border border-gray-300 text-sm rounded-full flex">
      <input type="text" name="search" placeholder="{{ __('home.search_input_placeholder') }}"
             class="flex-grow px-4 rounded-l-full rounded-r-full text-sm focus:outline-none" id="searchInput">
      <i class="fas fa-search m-3 mr-5 text-lg text-gray-700 w-4 h-4" id="searchStartIcon">
      </i>
      <i class="fas fa-times m-3 mr-5 text-lg text-gray-700 w-4 h-4" id="searchResetIcon" style="display: none">
      </i>
      <i class="fas fa-spinner m-3 mr-5 text-lg text-gray-700 w-4 h-4" id="searchSpinnerIcon" style="display: none">
      </i>
    </span>
    <div class="flex flex-row-reverse mr-8 md:flex">
        <div x-data="{ dropdownOpen: false }" class="relative flex flex-row-reverse mr-4 ml-4">
            <button @click="dropdownOpen = !dropdownOpen" class="relative z-10 block rounded p-2 focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>

            <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

            <div x-show="dropdownOpen" class="absolute right-0 mt-15 w-48 bg-white rounded-md overflow-hidden shadow-xl z-20">
                @guest
                    <a  href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">
                        {{__('home.links.login')}}
                    </a>
                    <a  href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">
                        {{__('home.links.register')}}
                    </a>
                    <a href="{{ route('login', ['test' => 1]) }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">
                        {{__('home.login_as_test_user')}}
                    </a>
                @endguest

                @auth
                        <a class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200" href="{{ route('profile.show') }}">
                            {{__('home.links.settings')}}
                        </a>
                        <a class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200" href="javascript:;" onclick="deleteAllMessages($(this));">
                            {{__('home.links.delete_all')}}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-dropdown-link href="{{ route('logout') }}"
                                             onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                            {{ __('Logout') }}
                        </x-jet-dropdown-link>
                    </form>
                @endauth
                <a  class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200" href="mailto:{{config('app.contact_mail')}}">
                    {{__('home.links.contact_me')}}
                </a>
            </div>
        </div>
        @auth
            <span class="hidden md:block py-2 px-2 m-2">
                {{ __('home.hi') }} {{ $username }}
            </span>
        @endauth
    </div>
</div>

@if(isset($errorMessage))
<x-alert type="error" :message="$errorMessage"/>
@endif
