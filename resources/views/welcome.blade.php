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
</head>

<body class="antialiased font-sans bg-gray-100">
<!-- Header -->
<header class="fixed top-0 left-0 right-0 z-50 bg-white shadow-md">
    @include('common.welcomeheader')
</header>

<!-- Main Content -->
<main class="pt-20"> <!-- Adjust padding-top to match the header height -->
    <!-- Video Cards Section -->
    <div class="container mx-auto p-4 pt-6 md:p-6">
        <div x-data="carousel()" class="relative w-full h-64 overflow-hidden rounded-lg shadow-md">
            <div class="carousel-inner relative w-full h-full">
                <!-- Carousel items -->
                <template x-for="(image, index) in images" :key="index">
                    <div x-show="currentIndex === index" class="carousel-item absolute w-full h-full transition-all duration-500 ease-in-out">
                        <img :src="image.src" :alt="'Image ' + (index + 1)" class="w-full h-full object-contain rounded-lg" />
                    </div>
                </template>
            </div>
            <!-- Carousel navigation -->
            <button @click="prevSlide" class="carousel-control-prev absolute top-1/2 left-4 transform -translate-y-1/2 z-30 flex items-center justify-center w-10 h-10 bg-black bg-opacity-50 rounded-full cursor-pointer group">
                <span class="carousel-control-prev-icon inline-block w-4 h-4 bg-white" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button @click="nextSlide" class="carousel-control-next absolute top-1/2 right-4 transform -translate-y-1/2 z-30 flex items-center justify-center w-10 h-10 bg-black bg-opacity-50 rounded-full cursor-pointer group">
                <span class="carousel-control-next-icon inline-block w-4 h-4 bg-white" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
            <!-- Carousel indicators -->
            <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-2 z-30">
                <template x-for="(image, index) in images" :key="index">
                    <button @click="currentIndex = index" :class="{
                        'bg-blue-600': currentIndex === index,
                        'bg-white': currentIndex !== index
                    }" class="w-2 h-2 rounded-full focus:outline-none" aria-current="true" :aria-label="'Slide ' + (index + 1)"></button>
                </template>
            </div>
        </div>
    </div>




    <!-- Filter Section -->
    <div class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <form action="{{ route('welcome') }}" method="GET" class="flex flex-col md:flex-row items-center justify-center space-x-4">
                <select name="category" id="category" class="p-2 rounded-md border-gray-300" onchange="showTitles(this.value)">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <div id="titles-checkboxes" class="flex flex-col md:flex-row items-center justify-center space-x-4"></div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Filter</button>
            </form>
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

<script>
    function showTitles(categoryId) {
        const titlesContainer = document.getElementById('titles-checkboxes');
        titlesContainer.innerHTML = ''; // Clear existing checkboxes

        if (!categoryId) return;

        fetch(`/get-titles-by-category/${categoryId}`)
            .then(response => response.json())
            .then(data => {
                data.titles.forEach(title => {
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'titles[]';
                    checkbox.value = title.id;
                    checkbox.className = 'p-2 rounded-md border-gray-300';

                    const label = document.createElement('label');
                    label.className = 'p-2';
                    label.appendChild(checkbox);
                    label.appendChild(document.createTextNode(title.title));

                    titlesContainer.appendChild(label);
                });
            });
    }
</script>

<script>
    function carousel() {
        return {
            currentIndex: 0,
            images: [
                { src: '/images/h2.jpg' },
                { src: '/images/b2.jpeg' },
                { src: '/images/b1.jpeg' },
                { src: '/images/b5.png' },
            ],
            prevSlide() {
                this.currentIndex = (this.currentIndex === 0) ? this.images.length - 1 : this.currentIndex - 1;
            },
            nextSlide() {
                this.currentIndex = (this.currentIndex === this.images.length - 1) ? 0 : this.currentIndex + 1;
            },
            init() {
                setInterval(() => {
                    this.nextSlide();
                }, 3000);

                this.$watch('currentIndex', () => {
                    const carouselItems = document.querySelectorAll('.carousel-item');
                    carouselItems.forEach((item, index) => {
                        item.style.display = (index === this.currentIndex) ? 'block' : 'none';
                    });
                });
            }
        };
    }

    document.addEventListener('alpine:init', () => {
        Alpine.data('carousel', carousel);
    });
</script>



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
