<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('about') }}" class="bg-blue-500 hover:bg-blue-700 text-sm text-white font-bold py-2 px-4 rounded mx-1">About Us</a>
            <a href="{{ route('contact') }}" class="bg-blue-500 hover:bg-blue-700 text-sm text-white font-bold py-2 px-4 rounded mx-1">Contact Us</a>
            <a href="{{ route('welcome') }}" class="bg-blue-500 hover:bg-blue-700 text-sm text-white font-bold py-2 px-4 rounded mx-1">Home</a>
        </div>
    </x-slot>
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-xl rounded-lg p-8">
            <h4 class="font-extrabold text-5xl text-purple-600">{{ $user->name }}'s Posts</h4>
            @foreach ($posts as $post)
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <h3 class="font-bold text-lg">{{ $post->title }}</h3>
                <p class="text-gray-600">{{ Str::limit($post->content, 50) }}</p>
                @if ($post->image)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="max-width: 200px; max-height: 200px;" class="rounded-lg">
                </div>
                @endif
                <p class="text-gray-500 text-sm">{{ $post->created_at->format('M d, Y') }}</p>
                @if(Auth::check() && Auth::user()->isAdmin())
                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-green-500 hover:bg-red-700 font-bold py-2 px-4 rounded">
                        Delete
                    </button>
                </form>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
