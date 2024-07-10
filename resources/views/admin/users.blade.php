
<x-app-layout>
@include('common.header')

   <br>
   <br>
   <div class="mb-4">
    <a href="{{ route('categories.create') }}" class="flex items-center justify-center ml-4 text-lg font-bold text-purple-600 hover:text-purple-800 border border-purple-600 hover:border-purple-800 w-32 h-12 rounded-md shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
        Add Category
    </a>
</div>


    <div class="container mx-auto p-6">
        <div class="bg-white shadow-xl rounded-lg p-8">
            <h3 class="font-extrabold text-3xl text-purple-600">Users</h3>
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
    @include('common.footer')
</x-app-layout>
