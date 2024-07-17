<x-app-layout>
    @include('common.header')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->title }}</title>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}
    <div class="container mx-auto mt-12 px-4">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        @if ($post->image)
            <div class="w-full h-80 bg-cover bg-center">
                <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-contain" alt="Post Image">
            </div>
        @else
            <div class="w-full h-80 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-400">No image available</span>
            </div>
        @endif
        <div class="p-6">
            <h2 class="text-3xl font-bold text-indigo-900 mb-4">{{ $post->title }}</h2>
            <p class="text-lg text-gray-700 mb-4">{!! $post->content !!}</p>
            <p class="text-sm text-gray-500 mt-2">{{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</p>
        </div>
    </div>
</div>

@include('common.footer')
</x-app-layout>
