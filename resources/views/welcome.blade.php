<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Blogs</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="{{ asset('css/swiper-custom.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/viewallblogs.css') }}">

    <style>
    .view-all-blogs-container {
        position: fixed;
        bottom: 10%;
        left: 2%;
        z-index: 50;
    }
    
    .view-all-blogs-button {
        display: inline-block;
        padding: 12px 24px;
        font-size: 1.2rem;
        font-weight: bold;
        color: #ffffff;
        background-color: #54595f;
        border: none;
        border-radius: 5px;
        text-transform: uppercase;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }
    
    .view-all-blogs-button::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 300%;
        height: 300%;
        background-color: rgba(255, 255, 255, 0.2);
        transition: all 0.3s;
        transform: translate(-50%, -50%) scale(0);
        border-radius: 50%;
    }
    
    .view-all-blogs-button:hover::before {
        transform: translate(-50%, -50%) scale(1);
    }
    
    .view-all-blogs-button:hover {
        background-color: #357ab8;
        transform: translateY(-3px);
    }
</style>    



    
    <style>
        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }
        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: black; }
        }
        .typing-container {
            display: inline-block;
            overflow: hidden;
            white-space: nowrap;
            border-right: .15em solid black;
            font-size: 3rem;
            font-family: 'Nunito', sans-serif;
            font-weight: bold;
            /* font-style: italic; */
            color: rgb(104, 91, 191);
            animation: typing 6s steps(40, end), blink-caret .75s step-end infinite;
        }
    </style>

<style>
    .image-container {
        position: relative;
        width: 1500px;
        height: 300px;
        margin: 0 auto;
    }
    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        border: 1px solid #4a5568;
    }
    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(to top, rgba(31, 41, 55, 0.8), transparent);
        border-radius: 0.5rem;
    }
    .wave-text {
        font-size: 4rem;
        font-weight: bold;
        font-style: italic;
        color: rgb(255, 255, 255);
        position: relative;
        white-space: nowrap;
    }
    @keyframes typing {
        0%, 100% {
            transform: translateX(0);
        }
        50% {
            transform: translateX(-50%);
        }
    }
    .wave-text::before {
        content: 'Write it!   Explore it!';
        position: absolute;
        left: 0;
        animation: typing 2s infinite;
    }
</style>

</head>

<body class="antialiased font-sans bg-gray-100">
<!-- Header -->
<header class="fixed top-0 left-0 right-0 z-50 bg-white shadow-md">
    @include('common.welcomeheader')
</header>

<!-- Main Content -->
<main class="pt-10"> <!-- Adjust padding-top to match the header height -->
    
    <!-- Filter Section -->
    {{-- <div class="container mx-auto mt-12 px-4">
        <div class="relative">
            <img src="{{ asset('images/welcome.png') }}" alt="Welcome" class="w-full h-auto rounded-lg shadow-lg border border-gray-600">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-800 to-transparent opacity-0 rounded-lg"></div>
        </div>
    </div> --}}

    <div class="flex justify-center items-center h-32">
        <div id="typing-container" class="typing-container">
            Welcome to The Blog Lover Site...!
        </div>
    </div>

    <div class="container mx-auto mt-10 px-2">
        <div class="image-container">
            <img src="{{ asset('images/welcome1.jpg') }}" alt="Welcome">
            <div class="image-overlay">
                <div class="wave-text"></div>
            </div>
        </div>
    </div>
    <!-- Latest Posts Section -->
    
    <div class="container mx-auto mt-12 px-4">
        <h3 class="text-3xl font-bold mb-6 text-left text-indigo-500 border-b-4 border-indigo-500 pb-2">Latest Posts</h3>
        <div class="swiper swiper-slider">
            <div class="swiper-wrapper">
                @foreach($posts as $post)
                    <div class="swiper-slide" style="background-image: url('{{ $post->image ? asset('storage/' . $post->image) : 'https://via.placeholder.com/400x200.png?text=No+Image' }}'); background-size: cover; background-position: center;">
                        <div class="content p-4 bg-black bg-opacity-60 text-white">
                            <h4 class="text-3xl font-bold mb-4">{{ $post->title }}</h4>
                            <p class="text-xl mb-1">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 50, '...') }}</p>
                            <a href="{{ route('post.show', $post->id) }}" class="text-xs text-blue-400 font-bold mt-1 inline-block">Continue Reading</a>
                            <br>
                            <br>
                            @if ($post->user)
                                <p class="text-xs mt-1">{{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</p>
                            @else
                                <p class="text-xs mt-1">{{ $post->created_at->diffForHumans() }} by Unknown</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
    
</div>



<div class="view-all-blogs-container">
    <a href="{{ route('post.allblogs') }}" class="view-all-blogs-button">
        View All Blogs
    </a>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
    <script>
        new Swiper('.swiper-slider', {
            centeredSlides: true,
            slidesPerView: 2,
            spaceBetween: 20,
            loop: true,
            mousewheel: false,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false
            },
            effect: 'coverflow',
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true
            }
        });
    </script>
</main>
<br>
<br>
<br>
@include('common.footer')





@if(session('status'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: "{{ session('status') }}",
            showConfirmButton: false,
            timer: 1500
        });
    });
</script>
@endif
</body>
</html>
