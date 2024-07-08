<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('about') }}" class="bg-blue-500 hover:bg-blue-700 text-sm text-white font-bold py-2 px-4 rounded mx-1">About Us</a>
            <a href="{{ route('profile.edit') }}" class="bg-blue-500 hover:bg-blue-700 text-sm text-white font-bold py-2 px-4 rounded mx-1">Profile</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-800">
                    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg">
                        <div class="px-6 py-4">
                            <h1 class="text-3xl font-bold mb-4 text-left text-pink-800">Add a Blog</h1>
                            @if(session('success'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('Post.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="title" class="block text-lg font-bold mb-2 text-gray-800">Title</label>
                                    <input type="text" id="title" name="title" value="" class="w-full pl-10 text-sm text-gray-800 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
                                </div>
                                <div class="mb-4">
                                    <label for="content" class="block text-lg font-bold mb-2 text-gray-800">Content</label>
                                    <textarea id="content" name="content" rows="6" class="w-full pl-10 text-sm text-gray-800 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" required></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="image" class="block text-lg font-bold mb-2 text-gray-800">Image</label>
                                    <input type="file" id="image" name="image" class="w-full pl-10 text-sm text-gray-800 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="bg-blue-500 hover:bg-orange-700 font-bold py-2 px-4 rounded-md text-white">Create Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
