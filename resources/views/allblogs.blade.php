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
    @include('common.welcomeheader')
</head>

<body>
    <main class="pt-10">
        <br>
        <br>
    <div class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <form action="{{ route('category') }}" method="GET" class="flex flex-col md:flex-row items-center justify-center space-x-4">
                <select name="category" id="category" class="p-2 rounded-md border-gray-300">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Filter</button>
            </form>
        </div>
    </div>


<div class="container mx-auto mt-12 px-4">
    <h3 class="text-3xl font-bold mb-6 text-left text-indigo-900 border-b-4 border-indigo-900 pb-2">Latest Posts</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($posts as $post)
            <div class="bg-white rounded-lg shadow-lg bg-blue-100 overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-2xl" style="height: 200px; width: 400px;">
                @if ($post->image)
                    <div class="w-full h-20 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $post->image) }}');"></div>
                @else
                    <div class="w-full h-20 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400">No image available</span>
                    </div>
                @endif
                <div class="p-3">
                    <h5 class="text-md font-bold text-indigo-800 mb-1">{{ $post->title }}</h5>
                    <p class="text-xs text-gray-700 mb-2 overflow-hidden text-ellipsis">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 50, '...') }}</p>
                    <a href="{{ route('post.show', $post->id) }}" class="text-xs text-blue-600 font-bold mt-1 inline-block">Read More</a>
                    @if ($post->user)
                        <p class="text-xs text-gray-500 mt-1">{{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</p>
                    @else
                        <p class="text-xs text-gray-500 mt-1">{{ $post->created_at->diffForHumans() }} by Unknown</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <!-- Pagination Links -->
    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</div>
    </main>
    @include('common.footer')
</body>