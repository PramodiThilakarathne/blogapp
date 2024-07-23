<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @include('common.welcomeheader')
    <br><br>
</head>
<body class="antialiased font-sans bg-gray-100">

<!-- Post Content Section -->
<div class="container mx-auto mt-12 px-4">
    <div class="h-full w-full flex flex-col lg:flex-row bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Image Section -->
        <div class="w-full lg:w-1/2 h-full overflow-hidden transition-transform duration-500 ease-in-out transform hover:scale-110 flex items-center justify-center">
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover" alt="Post Image">
            @else
                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400">No image available</span>
                </div>
            @endif
        </div>

        <!-- Content Section -->
        <div class="w-full lg:w-1/2 h-full p-6 flex flex-col justify-between transition-transform duration-500 ease-in-out transform hover:scale-105">
            <h1 class="text-4xl font-semibold mb-4 text-gray-800">{{ $post->title }}</h1>
            <p class="text-lg text-gray-600 mb-6 leading-relaxed">{!! $post->content !!}</p>
            <p class="text-sm text-gray-500 mt-2">{{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</p>
        </div>
    </div>

    

</div>

<!-- Comment Section -->
<div class="container mx-auto mt-8 px-4">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold mb-4">Comments</h2>

        <!-- Display existing comments -->
        @foreach ($comments as $comment)
            <div class="border-l-4 border-blue-700 p-4 mb-4 bg-gray-100 rounded-lg">
                <div class="flex items-start mb-2">
                    {{-- <div class="flex-shrink-0 mr-3">
                        <img class="w-10 h-10 rounded-full" src="{{ asset('storage/' . $comment->user->profile_photo_path) }}" alt="User Avatar">
                    </div> --}}
                    <div>
                        <p class="text-base font-semibold text-gray-900">{{ $comment->content }}</p>
                        <div class="text-gray-400 text-sm">{{ $comment->created_at->diffForHumans() }}</div>
                        <h3 class="text-sm text-gray-500">{{ $comment->user->name }}</h3>
                    </div>
                </div>

                <!-- Display existing replies -->
                @foreach ($comment->replies as $reply)
                    <div class="ml-12 border-l-4 border-blue-700 p-4 mb-4 bg-gray-100 rounded-lg">
                        <div class="flex items-start mb-2">
                            {{-- <div class="flex-shrink-0 mr-3">
                                <img class="w-8 h-8 rounded-full" src="{{ asset('storage/' . $reply->user->profile_photo_path) }}" alt="User Avatar">
                            </div> --}}
                            <div>
                                <p class="text-base font-semibold text-gray-900">{{ $reply->content }}</p>
                                <div class="text-gray-400 text-sm">{{ $reply->created_at->diffForHumans() }}</div>
                                <h3 class="text-sm text-gray-500">{{ $reply->user->name }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Reply form -->
                <form action="{{ route('replies.store', $comment) }}" method="POST" class="ml-12">
                    @csrf
                    <textarea name="content" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-2" placeholder="Add a reply..."></textarea>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Reply</button>
                </form>
            </div>
        @endforeach

        <!-- Comment form -->
        <form action="{{ route('comments.store', $post) }}" method="POST">
            @csrf
            <textarea name="content" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-2" placeholder="Add a comment..."></textarea>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Comment</button>
        </form>
    </div>
</div>

@if(session('comment_waiting'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('comment_waiting') }}",
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
@endif

@if(session('reply_waiting'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('reply_waiting') }}",
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
@endif

</body>
</html>
