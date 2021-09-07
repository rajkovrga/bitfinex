<div class="relative bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
            <nav class="hidden md:flex space-x-10">

                <a href="/" class="text-base font-medium text-gray-500 hover:text-gray-900">
                    Home
                </a>
                @if(session()->exists('isLogin'))
                    <a href="/fav" class="text-base font-medium text-gray-500 hover:text-gray-900">
                        Favorite
                    </a>
                @endif

            </nav>
            <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">

                @if(!session()->exists('isLogin'))
                    <a href="/login" class="px-3 py-1 whitespace-nowrap bg-green-500 border-2 rounded-lg text-gray-100 font-medium hover:text-gray-900">
                        Login
                    </a>
                @else
                    <a href="/logout" class="px-3 py-1 whitespace-nowrap bg-green-500 border-2 rounded-lg text-gray-100 font-medium hover:text-gray-900">
                        Logout
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
