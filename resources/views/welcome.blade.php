<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Blogs</title>

    @include('common.styles')
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
           
            animation: typing 10s steps(40, end), blink-caret .75s step-end infinite;
        }
    </style>

<style>
    
    .wave-text {
        font-size: 4rem;
        font-weight: bold;
        font-style: italic;
        color: rgb(24, 20, 20);
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
        left: 80;
        animation: typing 4s infinite;
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
        <div id="typing-container" class="typing-container text-blue-400">
            Welcome to The Blog Lover Site...!
        </div>
    </div>

    {{-- <div class="container mx-auto px-2">
        <div class="image-container">
            <img src="{{ asset('images/welcome1.jpg') }}" alt="Welcome">
            <div class="image-overlay flex flex-col justify-center items-center">
                <div class="wave-text"></div>
                <div class="mt-60"> <!-- Add mt-4 to add margin top -->
                    <a href="{{ route('post.allblogs') }}" class="text-sm text-black hover:text-blue-600 transition duration-300 ease-in-out py-5 px-4 rounded-full bg-blue-300 hover:bg-blue-200">
                        View All Blogs
                    </a>
                </div>
            </div>
        </div>
    </div> --}}


    <div class='py-12'>
        

  <div class="px-4 sm:px-10">
    <div class="min-h-[500px]">
      <div class="grid md:grid-cols-2 justify-center items-center gap-10">
        <div class="max-md:order-1">
          <p class="mt-4 mb-2 font-semibold text-blue-600"><span class="rotate-90 inline-block mr-2">|</span> ALL IN
            ONE
            PAGE</p>
          <h1 class="md:text-5xl text-4xl font-bold mb-4 md:!leading-[55px]">Share your ideas..!!</h1>
          <p class="mt-4 text-base leading-relaxed">Stay inspired and connected as we bring you the latest trends, 
            tips, and tales from the blog world. Join our community and let us guide you in crafting memorable moments
             around the table. Whether you're a seasoned foodie or a curious explorer, 
             our blog offers something delicious for everyone.</p>
         
          <div class="mt-10 grid grid-cols-2 md:grid-cols-4 gap-4 items-center">
            <img src="https://readymadeui.com/google-logo.svg" class="w-28 mx-auto" alt="google-logo" />
            <img src="https://readymadeui.com/facebook-logo.svg" class="w-28 mx-auto" alt="facebook-logo" />
            <img src="https://readymadeui.com/linkedin-logo.svg" class="w-28 mx-auto" alt="linkedin-logo" />
            {{-- <img src="https://readymadeui.com/pinterest-logo.svg" class="w-28 mx-auto" alt="pinterest-logo" /> --}}
          </div>
          <div class="wave-text flex-justify-center"></div>
        </div>
        <div class="max-md:mt-12 h-full">
          <img src="https://readymadeui.com/team-image.webp" alt="banner img" class="w-full h-full object-cover" />
        </div>
        <div class="mt-4"> <!-- Add mt-4 to add margin top -->
            <a href="{{ route('post.allblogs') }}" class="text-sm text-black hover:text-blue-600 transition duration-300 ease-in-out py-5 px-4 rounded-full bg-blue-300 hover:bg-blue-200">
                View All Blogs
            </a>
        </div>
      </div>
    </div>

    
    
<br>

    
    
    <!-- Latest Posts Section -->
<div class="container mx-auto mt-12 px-4">
        <h3 class="text-3xl font-bold mb-6 text-left text-indigo-500 border-b-4 border-indigo-500 pb-2">Latest Posts</h3>
        <div class="swiper swiper-slider">
            <div class="swiper-wrapper">
                @foreach($posts as $post)
                    <div class="swiper-slide" style="background-image: url('{{ $post->image ? asset('storage/' . $post->image) : 'https://via.placeholder.com/1200x600.png?text=No+Image' }}'); background-size: cover; background-position: center;">
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
<br>
<br>


<style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css');
</style>

<div class="min-w-screen min-h-screen bg-gray-50 flex items-center justify-center py-5">
    <div class="w-full bg-blue-50 border-t border-b border-gray-200 px-5 py-16 md:py-24 text-white-800">
        <div class="w-full max-w-6xl mx-auto">
            <div class="text-center max-w-xl mx-auto">
                <h1 class="text-6xl md:text-7xl font-bold mb-5 text-gray-600">What people <br>are saying.</h1>
                <h3 class="text-xl mb-5 font-light">Discover why our readers love us!</h3>
                <div class="text-center mb-10">
                    <span class="inline-block w-1 h-1 rounded-full bg-indigo-500 ml-1"></span>
                    <span class="inline-block w-3 h-1 rounded-full bg-indigo-500 ml-1"></span>
                    <span class="inline-block w-40 h-1 rounded-full bg-indigo-500"></span>
                    <span class="inline-block w-3 h-1 rounded-full bg-indigo-500 ml-1"></span>
                    <span class="inline-block w-1 h-1 rounded-full bg-indigo-500 ml-1"></span>
                </div>
            </div>
            <div class="-mx-3 md:flex items-start">
                <div class="px-3 md:w-1/3">
                    <div class="w-full mx-auto rounded-lg bg-white border border-gray-200 p-5 text-gray-800 font-light mb-6">
                        <div class="w-full flex mb-4 items-center">
                            <div class="overflow-hidden rounded-full w-10 h-10 bg-gray-50 border border-gray-200">
                                <img src="https://i.pravatar.cc/100?img=1" alt="">
                            </div>
                            <div class="flex-grow pl-3">
                                <h6 class="font-bold text-sm uppercase text-gray-600">Emily Brown.</h6>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="text-sm leading-tight">
                                <span class="text-lg leading-none italic font-bold text-gray-400 mr-1">"</span>
                                I absolutely love the diversity of topics on this blog! It's my go-to source for fresh perspectives and insightful articles. Keep up the great work!
                                <span class="text-lg leading-none italic font-bold text-gray-400 ml-1">"</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="px-3 md:w-1/3">
                    <div class="w-full mx-auto rounded-lg bg-white border border-gray-200 p-5 text-gray-800 font-light mb-6">
                        <div class="w-full flex mb-4 items-center">
                            <div class="overflow-hidden rounded-full w-10 h-10 bg-gray-50 border border-gray-200">
                                <img src="https://i.pravatar.cc/100?img=2" alt="">
                            </div>
                            <div class="flex-grow pl-3">
                                <h6 class="font-bold text-sm uppercase text-gray-600">Michael Lee.</h6>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="text-sm leading-tight">
                                <span class="text-lg leading-none italic font-bold text-gray-400 mr-1">"</span>
                                The blog is beautifully designed and easy to navigate. I always find something new and exciting to read. The writing style is engaging and thoughtful!
                                <span class="text-lg leading-none italic font-bold text-gray-400 ml-1">"</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="px-3 md:w-1/3">
                    <div class="w-full mx-auto rounded-lg bg-white border border-gray-200 p-5 text-gray-800 font-light mb-6">
                        <div class="w-full flex mb-4 items-center">
                            <div class="overflow-hidden rounded-full w-10 h-10 bg-gray-50 border border-gray-200">
                                <img src="https://i.pravatar.cc/100?img=3" alt="">
                            </div>
                            <div class="flex-grow pl-3">
                                <h6 class="font-bold text-sm uppercase text-gray-600">Sophia White.</h6>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="text-sm leading-tight">
                                <span class="text-lg leading-none italic font-bold text-gray-400 mr-1">"</span>
                                I'm constantly impressed by the quality of the articles and the insights shared by the contributors. This blog is a gem in the sea of online content.
                                <span class="text-lg leading-none italic font-bold text-gray-400 ml-1">"</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="-mx-3 md:flex items-start">
                <div class="px-3 md:w-1/3">
                    <div class="w-full mx-auto rounded-lg bg-white border border-gray-200 p-5 text-gray-800 font-light mb-6">
                        <div class="w-full flex mb-4 items-center">
                            <div class="overflow-hidden rounded-full w-10 h-10 bg-gray-50 border border-gray-200">
                                <img src="https://i.pravatar.cc/100?img=4" alt="">
                            </div>
                            <div class="flex-grow pl-3">
                                <h6 class="font-bold text-sm uppercase text-gray-600">James Green.</h6>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="text-sm leading-tight">
                                <span class="text-lg leading-none italic font-bold text-gray-400 mr-1">"</span>
                                I've been a subscriber for months, and every new post excites me. The topics are diverse, and the writing is always top-notch. Highly recommended!
                                <span class="text-lg leading-none italic font-bold text-gray-400 ml-1">"</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="px-3 md:w-1/3">
                    <div class="w-full mx-auto rounded-lg bg-white border border-gray-200 p-5 text-gray-800 font-light mb-6">
                        <div class="w-full flex mb-4 items-center">
                            <div class="overflow-hidden rounded-full w-10 h-10 bg-gray-50 border border-gray-200">
                                <img src="https://i.pravatar.cc/100?img=5" alt="">
                            </div>
                            <div class="flex-grow pl-3">
                                <h6 class="font-bold text-sm uppercase text-gray-600">Olivia Turner.</h6>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="text-sm leading-tight">
                                <span class="text-lg leading-none italic font-bold text-gray-400 mr-1">"</span>
                                As a fellow blogger, I find this site incredibly inspiring. The posts are well-researched and beautifully written. It's a fantastic resource for ideas.
                                <span class="text-lg leading-none italic font-bold text-gray-400 ml-1">"</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="px-3 md:w-1/3">
                    <div class="w-full mx-auto rounded-lg bg-white border border-gray-200 p-5 text-gray-800 font-light mb-6">
                        <div class="w-full flex mb-4 items-center">
                            <div class="overflow-hidden rounded-full w-10 h-10 bg-gray-50 border border-gray-200">
                                <img src="https://i.pravatar.cc/100?img=6" alt="">
                            </div>
                            <div class="flex-grow pl-3">
                                <h6 class="font-bold text-sm uppercase text-gray-600">Daniel Scott.</h6>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="text-sm leading-tight">
                                <span class="text-lg leading-none italic font-bold text-gray-400 mr-1">"</span>
                                I appreciate how this blog consistently delivers high-quality content. It's clear that the writers are passionate and knowledgeable about the subjects they cover.
                                <span class="text-lg leading-none italic font-bold text-gray-400 ml-1">"</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                depth: 400,
                modifier: 1,
                slideShadows: true
            }
        });
    </script>
</main>
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
