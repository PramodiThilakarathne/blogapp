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
            </div>
        </div>
    </x-slot>

    <div style="background-color: #fff; padding: 20px; width: 50%; margin: 40px auto; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <form action="{{ route('post.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div style="margin-bottom: 20px;">
                <label for="title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Title</label>
                <input type="text" id="title" name="title" value="{{ $post->title }}" style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 20px;">
                <label for="content" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Content</label>
                <textarea id="content" name="content" style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;">{{ $post->content }}</textarea>
            </div>
            <div style="margin-bottom: 20px;">
                <label for="image" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Image</label>
                <input type="file" id="image" name="image" style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;">
                @if ($post->image)
                    <div style="margin-top: 10px;">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="width: 100%; height: auto;">
                        </div>
                @endif
            </div>
            <button type="submit" style="background-color: #337ab7; color: #fff; padding: 10px 20px; font-size: 16px; border: none; border-radius: 5px; cursor: pointer;">Update Post</button>
        </form>
    </div>
</x-app-layout>
