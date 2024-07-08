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
            <h2 class="font-extrabold text-5xl text-pink-600">Users</h2>
            <table class="min-w-full bg-white mt-4 table-auto">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Posts</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.users.posts', $user->id) }}" class="text-blue-500 hover:underline">
                                {{ $user->name }}
                            </a>
                        </td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->posts_count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
