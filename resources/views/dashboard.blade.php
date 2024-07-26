<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <x-slot name="header">

        <style>
            .btn-fixed {
                width: 70px; /* Set the desired width */
                display: inline-block;
                text-align: center; /* Center the text within the button */
            }
        </style>

        <div class="flex justify-end items-center">
            <div class="flex items-center gap-x-2">
                <a href="{{ route('profile.edit') }}" class="text-sm text-black-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-300 hover:bg-blue-200">Profile</a>
                <a href="{{ route('welcome') }}" class="text-sm text-black-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-300 hover:bg-blue-200">Home</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-gray-300 text-gray-900">
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

    
        <div class="w-[100vw] mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden flex justify-center items-center">
                <div class="text-gray-900 flex flex-col md:flex-row shadow-xl">
                    <div class="w-fit flex flex-col lg:flex-row justify-center items-end">
                        <div class="text-black rounded border-purple/50 shadow-md border lg:mr-6 lg:w-fit px-6 h-[100%] py-6 flex flex-col justify-center">
                            <h1 class="text-lg font-bold">Your Username</h1>
                            <h2 class="text-md text-purple font-bold">{{ Auth::user()->name }}</h2>
                        </div>
                        <div class="text-black rounded border-purple/50 shadow-md border lg:w-fit h-[100%] px-6 py-6 flex flex-col justify-center">
                            <h1 class="text-lg font-bold">Your Email</h1>
                            <h2 class="text-md text-purple font-bold">{{ Auth::user()->email }}</h2>
                        </div>
                    </div>
                    <div class="text-black rounded border-purple/50 shadow-lg border lg:w-fit lg:ml-6 h-[100%] px-6 py-6 flex flex-col justify-center items-center">
                        <h2 class="text-5xl text-purple font-bold">{{ $postCount }}</h2>
                        <h1 class="text-md font-bold">Blogs Published</h1>
                    </div>
                </div>
            </div>
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
                                    <a href="{{ route('post.edit', $post) }}" class="btn-fixed bg-blue-300 hover:bg-yellow-600 text-white font-bold py-1 px-2 rounded-md shadow-md transition duration-300 ease-in-out focus:outline-none">Edit</a>
                                    <form id="delete-post-{{ $post->id }}" action="{{ route('post.destroy', $post->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-fixed bg-yellow-400 hover:bg-red-600 text-white font-bold py-1 px-2 rounded-md shadow-md transition duration-300 ease-in-out focus:outline-none" onclick="confirmDelete(event, 'delete-post-{{ $post->id }}')">Delete</button>
                                    </form>
                                    <a href="{{ route('post.show', $post) }}" class="btn-fixed bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-1 px-2 rounded-md shadow-md transition duration-300 ease-in-out focus:outline-none">View</a>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    @if(session('post_store'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('post_store') }}",
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('status'))
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('status') }}",
                    showConfirmButton: false,
                    timer: 1500
                });
            @endif
        });

        function confirmDelete(event, formId) {
            event.preventDefault();
            
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success ml-2", // Add a margin-left to the confirm button
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });
            
            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                    swalWithBootstrapButtons.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your blog file is safe :)",
                        icon: "error"
                    });
                }
            });
        }
    </script>
</x-app-layout>
@include('common.footer')
