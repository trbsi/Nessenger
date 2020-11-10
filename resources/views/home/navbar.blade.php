<div class="w-full flex flex-row items-center p-1 justify-between bg-white shadow-xs">
    <div class="ml-8 text-lg text-gray-700 hidden md:flex">{{ env('APP_NAME') }}</div>
    <span class="w-screen md:w-1/3 h-10 bg-gray-200 cursor-pointer border border-gray-300 text-sm rounded-full flex">
      <input type="search" name="serch" placeholder="Search"
             class="flex-grow px-4 rounded-l-full rounded-r-full text-sm focus:outline-none">
      <i class="fas fa-search m-3 mr-5 text-lg text-gray-700 w-4 h-4">
      </i>
    </span>
    <div x-data="{ dropdownOpen: false }" class="relative md:hidden lex flex-row-reverse mr-4 ml-4">
        <button @click="dropdownOpen = !dropdownOpen" class="relative z-10 block rounded p-2 focus:outline-none focus:bg-gray-700">
            <i class="fas fa-bars"></i>
        </button>

        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

        <div x-show="dropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-20">
            @guest
                <a  href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">
                    {{__('home.login')}}
                </a>
                <a  href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">
                    {{__('home.register')}}
                </a>
                <a href="{{ route('login', ['test' => 1]) }}" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">
                    {{__('home.login_as_test_user')}}
                </a>
            @endguest
            <a href="#" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200" href="mailto:{{config('app.contact_mail')}}">
                {{__('home.contact_me')}}
            </a>
        </div>
    </div>

    <div class="flex flex-row-reverse mr-8 hidden md:flex">
        @guest
        <div class="inline-flex">
            <a class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l my-2" href="{{ route('login') }}">
                {{__('home.login')}}
            </a>
            <a class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r my-2" href="{{ route('register') }}">
                {{__('home.register')}}
            </a>
        </div>
        <a class="inline-block border border-white rounded hover:border-gray-200 text-blue-500 hover:bg-gray-200 py-2 px-4 m-2"  href="{{ route('login', ['test' => 1]) }}">{{__('home.login_as_test_user')}}</a>
        @endguest
        <a class="inline-block border border-white rounded hover:border-gray-200 text-blue-500 hover:bg-gray-200 py-2 px-4 m-2" href="mailto:{{config('app.contact_mail')}}">{{__('home.contact_me')}}</a>
    </div>
</div>
