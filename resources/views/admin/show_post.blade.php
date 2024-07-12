<x-app-layout>
    @include('common.header')
    <br><br>
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-xl rounded-lg p-8">
            <h4 class="font-extrabold text-3xl text-purple-600">{{ $post->title }}</h4>
            <p class="text-gray-700">{!! $post->content !! }</p>
            @if ($post->image)
            <div class="mt-4">
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="rounded-lg">
            </div>
            @endif
        </div>
    </div>
    @include('common.footer')
</x-app-layout>
