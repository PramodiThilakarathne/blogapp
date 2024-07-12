<x-app-layout>
    @include('common.header')
    <br><br>
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-xl rounded-lg p-8">
            <h2 class="font-extrabold text-3xl text-purple-600">{{ $user->name }}'s Posts</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr class="text-left">
                            <th class="py-3 px-4">Title</th>
                            <th class="py-3 px-4">Category</th>
                            <th class="py-3 px-4">Content</th>
                            <th class="py-3 px-4">Image</th>
                            <th class="py-3 px-4">Created At</th>
                            <th class="py-3 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $post->title }}</td>
                            <td class="py-3 px-4">{{ optional($post->category)->name }}</td>
                            <td class="py-3 px-4">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100, '...') }}</td>
                            <td class="py-3 px-4">
                                @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-20 h-auto">
                                @else
                                <span class="text-gray-400">No image available</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">{{ $post->created_at->format('M d, Y') }}</td>
                            <td class="py-3 px-4">
                                <div class="flex space-x-2">
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
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('common.footer')
</x-app-layout>
