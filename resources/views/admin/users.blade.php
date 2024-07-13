<x-app-layout>
    @include('common.header')

    @if(session('category_success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('category_success') }}",
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
    @endif
    
    @if(session('user_success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('user_success') }}",
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
    @endif

    @if(session('user_update'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('user_update') }}",
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
    @endif

    @if(session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('status') }}",
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
    @endif

    <br>
    <br>
 <div class="mb-4 flex justify-start items-center space-x-4"> <!-- Added space-x-4 for spacing -->
        <a href="{{ route('categories.create') }}" class="flex items-center justify-center text-lg font-bold text-purple-600 hover:text-purple-800 border border-purple-600 hover:border-purple-800 w-32 h-12 rounded-md shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
            Add Category
        </a>
        <a href="{{ route('admin.users.create') }}" class="flex items-center justify-center text-lg font-bold text-purple-600 hover:text-purple-800 border border-purple-600 hover:border-purple-800 w-32 h-12 rounded-md shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
            Add User /
            <br> Add Admin
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
                        <th class="px-4 py-2 text-left">Actions</th>
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
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                            <form id="delete-user-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="text-red-600 hover:text-red-900" onclick="confirmDelete(event, '{{ $user->id }}')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('common.footer')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmDelete(event, userId) {
            event.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success ml-2",
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
                    document.getElementById('delete-user-' + userId).submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "user is safe :)",
                        icon: "error"
                    });
                }
            });
        }
    </script>
</x-app-layout>
