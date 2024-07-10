<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blogs</title>
 
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="antialiased font-sans bg-gray-100">

<!-- Header -->
<header class="fixed top-0 left-0 right-0 z-50 bg-white shadow-md">
    @include('common.welcomeheader')
</header>

<!-- Main Content -->
<main class="pt-20"> <!-- Adjust padding-top to match the header height -->
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
                        <p class="text-xs text-gray-500 mt-1">{{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</p>
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
</html>
