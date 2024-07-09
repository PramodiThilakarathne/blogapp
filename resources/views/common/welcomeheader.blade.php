<div class="fixed top-0 w-full bg-white shadow flex items-center px-4 py-2">
    
    <div class="flex items-center">
        <img src="/images/b5.png" class="w-16 h-16" alt="hos_logo">
        <h2 class="text-indigo-900 font-bold ml-4">Welcome to My Blogs !!</h2>
    </div>
  
    <div class="flex items-center ml-auto pr-6 space-x-4">
                <a href="{{ route('about') }}" class="text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">About Us</a>
                <a href="{{ route('contact') }}" class="text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">Contact Us</a>
            </div>

            <!-- Login and Register Links -->
            @if (Route::has('login'))
                <div class="flex items-center pr-6 space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
