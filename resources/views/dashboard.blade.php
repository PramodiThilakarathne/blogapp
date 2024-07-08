<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="flex items-center gap-x-2">
                <a href="{{ route('profile.edit') }}" class="bg-blue-500 hover:bg-blue-700 text-sm text-white font-bold py-2 px-4 rounded mx-1">Profile</a>
                <a href="{{ route('about') }}" class="bg-blue-500 hover:bg-blue-700 text-sm text-white font-bold py-2 px-4 rounded mx-1">About Us</a>
                <a href="{{ route('contact') }}" class="bg-blue-500 hover:bg-blue-700 text-sm text-white font-bold py-2 px-4 rounded mx-1">Contact Us</a>
                <a href="{{ route('welcome') }}" class="bg-blue-500 hover:bg-blue-700 text-sm text-white font-bold py-2 px-4 rounded mx-1">Home</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    {{ __("This is your blog page!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto p-4 grid grid-cols-2 gap-4">
        @foreach ($userPosts as $post)
            <div class="bg-white rounded shadow-md overflow-hidden flex flex-col justify-between p-4 border border-gray-200" style="height: 400px; width: 400px;">
                <div>
                    <div class="font-bold text-xl mb-2">{{ $post->title }}</div>
                    <p class="text-gray-700 text-base">{{ $post->content }}</p>
                </div>
                @if ($post->image)
                    <div class="mt-4 flex items-center justify-center" style="height: 200px; width: 100%; overflow: hidden;">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="height: 100%; width: auto; max-width: none;">
                    </div>
                @else
                    <div class="mt-4 flex items-center justify-center" style="height: 200px; width: 100%; background-color: #f3f4f6;">
                        <span class="text-gray-400">No image available</span>
                    </div>
                @endif
                <div class="flex justify-end mt-auto">
                    <a href="{{ route('post.edit', $post) }}" class="bg-green-500 hover:bg-blue-700 font-bold py-2 px-4 rounded shadow transition focus:outline-none mr-4">Edit</a>
                    <form action="{{ route('post.destroy', $post) }}" method="post" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-purple-500 hover:bg-red-700 font-bold py-2 px-4 rounded shadow transition focus:outline-none">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

</x-app-layout>
