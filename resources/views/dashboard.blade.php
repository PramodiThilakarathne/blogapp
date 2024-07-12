<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-end items-center">
            <div class="flex items-center gap-x-2">
                <a href="{{ route('profile.edit') }}" class="text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">Profile</a>
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

    <div class="container mx-auto p-4">
        <div class="-mx-4">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="py-2 px-3 text-left">Title</th>
                            <th class="py-2 px-3 text-left">Category</th>
                            <th class="py-2 px-3 text-left">Content</th>
                            <th class="py-2 px-3 text-left">Image</th>
                            <th class="py-2 px-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($userPosts as $post)
                            <tr class="hover:bg-gray-100">
                                <td class="py-3 px-4">{{ $post->title }}</td>
                                <td class="py-3 px-4">{{ $post->category->name }}</td>
                                <td class="py-3 px-4">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100, '...') }}</td>
                                <td class="py-3 px-4">
                                    @if ($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-20 h-auto">
                                    @else
                                        <span class="text-gray-400">No image available</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center space-x-2">
                                    <a href="{{ route('post.edit', $post) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-2 rounded-md shadow-md transition duration-300 ease-in-out focus:outline-none">Edit</a>
                                    <form action="{{ route('post.destroy', $post) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-1 px-2 rounded-md shadow-md transition duration-300 ease-in-out focus:outline-none">Delete</button>
                                    </form>
                                    <a href="{{ route('post.show', $post) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded-md shadow-md transition duration-300 ease-in-out focus:outline-none">View</a>
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
