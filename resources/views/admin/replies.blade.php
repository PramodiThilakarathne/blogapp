<x-app-layout>
    @include('common.header')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Main Layout Wrapper -->
    {{-- <div class="min-h-screen flex flex-col"> --}}
        <!-- Main Content -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-black-100">
                        @if ($replies->isEmpty())
                            <p>No replies pending approval.</p>
                        @else
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 dark:text-black-100">Reply</th>
                                        <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 dark:text-black-100">User</th>
                                        <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 dark:text-black-100">Corresponding Comment</th>
                                        <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 dark:text-black-100">Post</th>
                                        <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 dark:text-black-100">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="replies-tbody">
                                    @foreach ($replies as $reply)
                                        <tr id="reply-{{ $reply->id }}">
                                            <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">{{ $reply->content }}</td>
                                            <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">{{ $reply->user->name }}</td>
                                            <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">{{ $reply->comment->content }}</td>
                                            <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700"><a href="{{ route('post.show', $reply->comment->post->id) }}">{{ $reply->comment->post->title }}</a></td>
                                            <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                                <button type="button" class="px-4 py-2 bg-green-500 text-white rounded-md" onclick="approveReply({{ $reply->id }})">Approve</button>
                                                <button type="button" class="px-4 py-2 bg-red-500 text-white rounded-md" onclick="confirmDelete(event, 'reject-reply-{{ $reply->id }}')">Reject</button>
                                                <form id="reject-reply-{{ $reply->id }}" action="{{ route('admin.replies.reject', $reply) }}" method="POST" class="hidden">
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        

    @if(session('reply_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "{{ session('reply_success') }}",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        </script>
    @endif

    @if(session('reply_reject'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "{{ session('reply_reject') }}",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        </script>
    @endif
</x-app-layout>

<script>
    function approveReply(replyId) {
        fetch(`/admin/replies/${replyId}/approve`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(response => response.json())
          .then(data => {
              if (data.success) {
                  Swal.fire({
                      icon: 'success',
                      title: data.message,
                      showConfirmButton: false,
                      timer: 1500
                  });
                  document.getElementById(`reply-${replyId}`).remove();
              }
          });
    }

    function confirmDelete(event, formId) {
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
                document.getElementById(formId).submit();
                swalWithBootstrapButtons.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Your reply is safe :)",
                    icon: "error"
                });
            }
        });
    }
</script>
 @include('common.footer')