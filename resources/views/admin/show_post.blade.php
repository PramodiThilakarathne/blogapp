<x-app-layout>
    @include('common.header')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->title }}</title>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}
    <style>
        .comment-box, .reply-box {
            border-left: 4px solid #1D4ED8;
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: #F9FAFB;
            border-radius: 0.5rem;
        }

        .comment-box h3, .reply-box h3 {
            font-size: 0.875rem; /* Small text */
            color: #9195a3;
        }

        .comment-box p, .reply-box p {
            font-size: 16px; /* Highlighted text */
            font-weight: 600;
            color: #0d0f12;
        }
    </style>

<style>
    .button {
      --😀: #18a1d7;
      /* --😀😀: #141316;
      --😀😀😀: #0d0d0f63; */
      cursor: pointer;
      width: 100px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 1rem;
      font-size: 1rem;
      font-weight: 600;
      letter-spacing: 2px;
      color: #fff;
      background: var(--😀);
      border: 2px solid var(--😀😀);
      border-radius: .75rem;
      
      transform: skew(-10deg);
      transition: all .1s ease;
      filter: drop-shadow(0 15px 20px var(--😀😀😀));
    }
    
    .button:active {
      letter-spacing: 0px;
      transform: skew(-10deg) translateY(8px);
      box-shadow: 0 0 0 var(--😀😀😀);
    }
        </style>

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

<div class="container mx-auto mt-8 px-4">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold mb-4">Comments</h2>

        <!-- Display existing comments -->
        @foreach ($comments as $comment)
            <div class="comment-box">
                <div class="flex items-start mb-2">
                    {{-- <div class="flex-shrink-0 mr-3">
                        <img class="w-10 h-10 rounded-full" src="{{ asset('storage/' . $comment->user->profile_photo_path) }}" alt="User Avatar">
                    </div> --}}
                    <div>
                        
                        <p>{{ $comment->content }}</p>
                        <div class="text-gray-400 text-sm">{{ $comment->created_at->diffForHumans() }}</div>
                        <h3 class="text-lg font-semibold">{{ $comment->user->name }}</h3>
                    </div>
                </div>

                <!-- Display existing replies -->
                @foreach ($comment->replies as $reply)
                    <div class="reply-box ml-12">
                        <div class="flex items-start mb-2">
                            {{-- <div class="flex-shrink-0 mr-3">
                                <img class="w-8 h-8 rounded-full" src="{{ asset('storage/' . $reply->user->profile_photo_path) }}" alt="User Avatar">
                            </div> --}}
                            <div>
                               
                                <p>{{ $reply->content }}</p>
                                <div class="text-gray-400 text-sm">{{ $reply->created_at->diffForHumans() }}</div>
                                <h3 class="text-lg font-semibold">{{ $reply->user->name }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Reply form -->
                <form action="{{ route('replies.store', $comment) }}" method="POST" class="ml-12">
                    @csrf
                    <textarea name="content" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-2" placeholder="Add a reply..."></textarea>
                    <button type="submit" class="button " required>Reply</button>
                </form>
            </div>
        @endforeach

        <!-- Comment form -->
        <form action="{{ route('comments.store', $post) }}" method="POST">
            @csrf
            <textarea name="content" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-2" placeholder="Add a comment..."></textarea>
            <button type="submit" class="button " required>Comment</button>
        </form>
    </div>
</div>

</x-app-layout>
@include('common.footer')
