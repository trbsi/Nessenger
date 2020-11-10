<div class="w-screen flex flex-row items-center p-1 justify-between bg-white shadow-xs">
    <div class="ml-8 text-lg text-gray-700 hidden md:flex">My Website</div>
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
            <a href="#" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">small <span class="text-gray-600">(640x426)</span></a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">medium <span class="text-gray-600">(1920x1280)</span></a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">large <span class="text-gray-600">(2400x1600)</span></a>
        </div>
    </div>

    <div class="flex flex-row-reverse mr-8 hidden md:flex">
        <div class="text-gray-700 text-center bg-gray-400 px-4 py-2 m-2">Button</div>
        <div class="text-gray-700 text-center bg-gray-400 px-4 py-2 m-2">Link</div>
    </div>
</div>
