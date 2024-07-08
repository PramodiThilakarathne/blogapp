<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blogs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="antialiased font-sans bg-gray-100">

<!-- Header -->
<div class="fixed top-0 w-full bg-white shadow flex items-center px-4 py-2">
    <div class="flex items-center">
        <img src="/images/b5.png" class="w-16 h-16" alt="hos_logo">
        <h4 class="text-indigo-900 font-bold ml-4">Blogs !!</h4>
    </div>
    <div class="flex-grow flex items-center justify-center">
        <h3 class="text-3xl font-bold text-light blue-900">Welcome to Humpty Dumpty's Blogs</h3>
    </div>
    @if (Route::has('login'))
        <div class="ml-auto flex items-center pr-6">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif
</div>

<br>
<br>
<br>

<!-- Video Cards Section -->
<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- First Video Card -->
            <div class="col-span-1 bg-blue-100">
                <div class="card rounded-lg overflow-hidden shadow-lg" style="height: 400px; width: 400px;">
                    <a href="https://redeemingtruthmedia.org/music/"
                       class="block w-full h-60 bg-cover bg-center"
                       style="background-image: url('https://redeemingtruthmedia.org/wp-content/uploads/2023/08/P1522385-1-767x1024.jpg');">
                        <video autoplay muted loop class="w-full h-full object-cover">
                            <source src="https://redeemingtruthmedia.org/wp-content/uploads/2024/05/Hisalonefrontpage.mp4"
                                    type="video/mp4">
                        </video>
                    </a>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Music</h3>
                        <p class="text-sm text-gray-600">Songs that are doctrinally sound to be sung congregationally when we gather together in our local churches.</p>
                        <a href="https://redeemingtruthmedia.org/music/" class="text-sm text-blue-600 font-bold mt-2 inline-block">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Second Video Card -->
            <div class="col-span-1 bg-blue-100">
                <div class="card rounded-lg overflow-hidden shadow-lg" style="height: 400px; width: 400px;">
                    <a href="https://redeemingtruthmedia.org/podcast/"
                       class="block w-full h-60 bg-cover bg-center"
                       style="background-image: url('https://redeemingtruthmedia.org/wp-content/uploads/2023/08/home_podcast.jpg');">
                        <video autoplay muted loop class="w-full h-full object-cover">
                            <source src="https://redeemingtruthmedia.org/wp-content/uploads/2024/05/redeeming-truth-podcast.mp4"
                                    type="video/mp4">
                        </video>
                    </a>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Podcast</h3>
                        <p class="text-sm text-gray-600">Podcasts and short videos that speak into many biblical and cultural issues of our day. We hope these videos equip you to live a life to know, love and serve Jesus.</p>
                        <a href="https://redeemingtruthmedia.org/podcast/" class="text-sm text-blue-600 font-bold mt-2 inline-block">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Third Video Card -->
            <div class="col-span-1 bg-blue-100">
                <div class="card rounded-lg overflow-hidden shadow-lg" style="height: 400px; width: 400px;">
                    <a href="https://redeemingtruthmedia.org/publishing/"
                       class="block w-full h-60 bg-cover bg-center"
                       style="background-image: url('https://redeemingtruthmedia.org/wp-content/uploads/2023/08/home_publishing.jpg');">
                        <video autoplay muted loop class="w-full h-full object-cover">
                            <source src="https://redeemingtruthmedia.org/wp-content/uploads/2024/05/Sample-Video.mp4"
                                    type="video/mp4">
                        </video>
                    </a>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Publishing</h3>
                        <p class="text-sm text-gray-600">Blog posts and articles that encourage believers in their walk with the Lord.</p>
                        <a href="https://redeemingtruthmedia.org/publishing/" class="text-sm text-blue-600 font-bold mt-2 inline-block">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Latest Posts Section -->
<div class="container mx-auto mt-12 px-4">
    <h3 class="text-3xl font-bold mb-6 text-left text-indigo-900 border-b-4 border-indigo-900 pb-2">Latest Posts</h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($posts as $post)
            <div class="bg-green-100 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h5 class="text-xl font-bold text-indigo-800 mb-2">{{ $post->title }}</h5>
                    <p class="text-gray-700 mb-4">{{ Str::limit($post->content, 100) }}</p>
                    <a href="{{ route('post.show', $post->id) }}" class="inline-block text-blue-600 hover:text-blue-800 font-semibold transition duration-200">Read More</a>
                    <p class="text-sm text-gray-500 mt-2">{{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</p>
                </div>
                @if ($post->image)
                    <div class="w-full h-60 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $post->image) }}');"></div>
                @else
                    <div class="w-full h-60 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400">No image available</span>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
<!-- Footer Section -->
<div class="bg-blue-200 shadow-md rounded px-8 py-6 mt-12 mb-4">
    <div class="flex justify-center mb-4">
        <img src="/images/h.jpeg" alt="Humpty Dumpty" class="w-12 h-12 rounded-full mr-8">
        <h4 class="text-lg font-bold text-gray-800">Humpty Dumpty's Blog</h4>
    </div>
    
    <div class="flex justify-center mb-4">
        <a href="#" target="_blank" class="text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out mr-4">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#" target="_blank" class="text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out mr-4">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="#" target="_blank" class="text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out mr-4">
            <i class="fab fa-linkedin-in"></i>
        </a>
        <a href="#" target="_blank" class="text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out mr-4">
            <i class="fab fa-instagram"></i>
        </a>
    </div>
    <div class="flex justify-center mb-4">
        <h4 class="text-lg font-bold text-gray-800">Quick Links</h4>
    </div>
    <nav class="flex justify-center mb-4">
        <a href="{{ route('profile.edit') }}" class="text-black-600 hover:text-gray-900 transition duration-300 ease-in-out mr-4">Profile</a>
        <a href="{{ route('about') }}" class="text-black-600 hover:text-gray-900 transition duration-300 ease-in-out mr-4">About Us</a>
        <a href="{{ route('contact') }}" class="text-black-600 hover:text-gray-900 transition duration-300 ease-in-out mr-4">Contact Us</a>
    </nav>
    <div class="text-center text-black-600 text-sm">
        <p>© 2024 — humptydumpty.net . All Rights Reserved.</p>
    </div>
</div>

</body>
</html>
