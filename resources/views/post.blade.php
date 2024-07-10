
<x-app-layout>
<head>
    
@include('common.header')
    <!-- Include CKEditor 5 from CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
</head>

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-800">
                    <div class="w-[50vw] bg-white shadow-md rounded-lg">
                        <div class="w-[50vw] px-6 py-4">
                            <h1 class="text-3xl font-bold mb-4 text-left text-pink-800">Add a Blog</h1>
                            @if(session('success'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('Post.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="w-[50vw] mb-4">
                                    <label for="title" class="block text-lg font-bold mb-2 text-gray-800">Title</label>
                                    <input type="text" id="title" name="title" value="" class="w-full pl-10 text-sm text-gray-800 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
                                </div>
                                <!-- <div class="mb-4">
                                    <label for="content" class="block text-lg font-bold mb-2 text-gray-800">Content</label>
                                    <textarea id="content" name="content" rows="6" class="w-full pl-10 text-sm text-gray-800 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" required></textarea>
                                </div> -->
                                    <div class="w-[50vw] mb-4">
                                    <textarea name="content"></textarea>
                                    </div>


                                <div class="w-[50vw] mb-4">
                                    <label for="image" class="block text-lg font-bold mb-2 text-gray-800">Image</label>
                                    <input type="file" id="image" name="image" class="w-full pl-10 text-sm text-gray-800 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="bg-blue-500 hover:bg-orange-700 font-bold py-2 px-4 rounded-md text-white">Create Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('textarea'))
            .then(editor => {
                console.log('Editor was initialized', editor);
            })
            .catch(error => {
                console.error('Error during initialization of the editor', error);
            });
    </script>

@include('common.footer')
</x-app-layout>
