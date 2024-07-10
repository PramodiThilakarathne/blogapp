<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-end items-center">
    <div class="flex items-center gap-x-2">
        <a href="{{ route('profile.edit') }}" class="text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">Profile</a>
        <a href="{{ route('about') }}" class="text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">About Us</a>
        <a href="{{ route('contact') }}" class="text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">Contact Us</a>
        <a href="{{ route('welcome') }}" class="text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">Home</a>
    </div>
</div>

    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-blue-100 text-gray-900">
                    {{ __("This is your blog page!") }}
                </div>
            </div>
        </div>
    </div>



    
    <div class="mb-4">
        <a href="{{ route('Post.index') }}" class="flex items-center justify-center ml-4 text-lg font-bold text-purple-600 hover:text-purple-800 border border-purple-600 hover:border-purple-800 w-32 h-12 rounded-md shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
            Add a blog
        </a>
    </div>

    <div class="container mx-auto p-4 grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($userPosts as $post)
            <div class="relative rounded-lg shadow-lg overflow-hidden" style="height: 400px;">
                <div class="p-4 flex flex-col justify-between h-full">
                    <div>
                        <div class="font-bold text-xl mb-2">{{ $post->title }}</div>
                        <p class="text-gray-700 text-base overflow-hidden" style="max-height: 80px;">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100, '...') }}</p>
                    </div>
                    @if ($post->image)
                        <div class="mt-4">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full h-48 object-cover" style="max-height: 150px;">
                        </div>
                    @else
                        <div class="mt-4 flex items-center justify-center" style="height: 150px; width: 100%; background-color: #f3f4f6;">
                            <span class="text-gray-400">No image available</span>
                        </div>
                    @endif
                    <div class="flex justify-end items-center mt-auto space-x-2">
                        <a href="{{ route('post.edit', $post) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-3 rounded-md shadow-md transition duration-300 ease-in-out focus:outline-none">Edit</a>
                        <form action="{{ route('post.destroy', $post) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-3 rounded-md shadow-md transition duration-300 ease-in-out focus:outline-none">Delete</button>
                        </form>
                        <a href="{{ route('post.show', $post) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-3 rounded-md shadow-md transition duration-300 ease-in-out focus:outline-none">View</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @include('common.footer')

    <style>
        /* Hover effect for Edit button */
        .bg-green-500:hover {
            background-color: #2d7d2a; /* Darker shade of green */
        }

        /* Hover effect for Delete button */
        .bg-purple-500:hover {
            background-color: #7932b8; /* Darker shade of purple */
        }

        /* Hover effect for View button */
        .bg-blue-500:hover {
            background-color: #2b6cb0; /* Darker shade of blue */
        }

        /* Ensure fixed size for buttons */
        .bg-green-500, .bg-purple-500, .bg-blue-500 {
            width: 100px;
            text-align: center;
        }
    </style>
</x-app-layout>
