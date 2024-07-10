<x-app-layout>
    @include('common.header')
    <br><br>
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-xl rounded-lg p-8">
            <h2 class="font-extrabold text-3xl text-purple-600">{{ $user->name }}'s Posts</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($posts as $post)
                <div class="bg-white shadow-md rounded-lg p-4 mb-4 flex flex-col h-96">
                    <h3 class="font-bold text-lg mb-2">{{ $post->title }}</h3>
                    <p class="text-gray-600 overflow-hidden mb-4" style="height: 80px;">{!! Str::limit($post->content, 50) !!}</p>
                    @if ($post->image)
                    <div class="overflow-hidden mb-4 h-36">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="rounded-lg w-full h-full object-cover">
                    </div>
                    @else
                    <div class="flex items-center justify-center mb-4 h-36 bg-gray-100">
                        <span class="text-gray-400">No image available</span>
                    </div>
                    @endif
                    <p class="text-gray-500 text-sm mb-2">{{ $post->created_at->format('M d, Y') }}</p>
                    <div class="mt-auto flex space-x-2">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Edit</a>
                        <a href="{{ route('admin.posts.show', $post) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">View</a>
                        @if(Auth::check() && Auth::user()->isAdmin())
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('common.footer')
</x-app-layout>
