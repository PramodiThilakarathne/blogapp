

<div class="fixed top-0 w-full bg-white shadow flex items-center px-4 py-2">
    
    <div class="flex items-center">
        <img src="/images/b5.png" class="w-16 h-16" alt="hos_logo">
        <div data-mesh-id="comp-ki7i1ojainlineContent" data-testid="inline-content" class=""><div data-mesh-id="comp-ki7i1ojainlineContent-gridContainer" data-testid="mesh-container-content"><div id="comp-ki79rmsk" class="comp-ki79rmsk wixui-vector-image"><a data-testid="linkElement" target="_self" class="a9YhBi"><div data-testid="svgRoot-comp-ki79rmsk" class="AKxYR5 VZYmYf comp-ki79rmsk"><!--?xml version="1.0" encoding="UTF-8"?-->
            
            </div></a></div><div id="comp-ki79nl5d" class="HcOXKn SxM0TO QxJLC3 comp-ki79nl5d wixui-rich-text" data-testid="richTextElement"><p class="font_3 wixui-rich-text__text" style="font-size:30px;">T.B.L</a></p></div></div></div>
    </div>
  
    <div class="flex items-center ml-auto pr-6 space-x-4">
                <a href="{{ route('about') }}" class="text-sm text-black hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-300 hover:bg-blue-200">About Us</a>
                <a href="{{ route('contact') }}" class="text-sm text-black hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-300 hover:bg-blue-200">Contact Us</a>
            </div>

            <!-- Login and Register Links -->
            @if (Route::has('login'))
                <div class="flex items-center pr-6 space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-black hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-300 hover:bg-blue-200">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-black hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-300 hover:bg-blue-200">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm text-black hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-300 hover:bg-blue-200">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
