<x-app-layout>
    @include('common.header')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="min-h-screen flex flex-col">
        <!-- Main Content -->
        <div class="flex-grow py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-black-100">
                        @if ($comments->isEmpty())
                            <p>You have no comments.</p>
                        @else
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 dark:text-black-100">Comment</th>
                                        <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 dark:text-black-100">Post</th>
                                        <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 dark:text-black-100">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $comment)
                                        <tr>
                                            <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">{{ $comment->content }}</td>
                                            <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700"><a href="{{ route('post.show', $comment->post->id) }}">{{ $comment->post->title }}</a></td>
                                            <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                                @if ($comment->approved)
                                                    <span class="text-green-500">Approved</span>
                                                @else
                                                    <span class="text-red-500">Pending Approval</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @foreach ($comment->replies as $reply)
                                            <tr>
                                                <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700" style="padding-left: 40px;">{{ $reply->content }}</td>
                                                <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700"><a href="{{ route('post.show', $reply->post->id) }}">{{ $reply->post->title }}</a></td>
                                                <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                                    @if ($reply->approved)
                                                        <span class="text-green-500">Approved</span>
                                                    @else
                                                        <span class="text-red-500">Pending Approval</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        @include('common.footer')
    </div>

    @if(session('comment_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "{{ session('comment_success') }}",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        </script>
    @endif

    @if(session('comment_reject'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "{{ session('comment_reject') }}",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        </script>
    @endif

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
