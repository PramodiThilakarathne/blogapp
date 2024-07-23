<x-app-layout>
<head>
    @include('common.header')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
</head>

<div class="w-full px-6 py-4">
<h1 class="text-3xl font-bold mb-4 text-left text-pink-800">Update the post</h1>
    <div style="background-color: #fff; padding: 40px; width: 100%; margin: 40px auto; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <form action="{{ route('post.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div style="margin-bottom: 20px;">
                <label for="title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Title</label>
                <input type="text" id="title" name="title" value="{{ $post->title }}" style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label for="category_id" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Category</label>
                <select name="category_id" id="category_id" style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;">
                    <option name="category" disabled selected>Select a category</option>
                    @isset($categories)
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>

            <div class="w-full mb-4">
                <label for="content" class="block text-lg font-bold mb-2 text-gray-800">Content</label>
                <textarea id="content" name="content">{{ $post->content }}</textarea>
            </div>
            
            
            <div style="margin-bottom: 20px;">
                <label for="image" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Image</label>
                <input type="file" id="image" name="image" style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;">
                @if ($post->image)
                    <div style="margin-top: 10px;">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="width: 100%; height: auto;">
                    </div>
                @endif
            </div>
            <button type="submit" style="background-color: #337ab7; color: #fff; padding: 10px 20px; font-size: 16px; border: none; border-radius: 5px; cursor: pointer;">Update Post</button>
        </form>
    </div>
</div>

    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(editor => {
                console.log('Editor was initialized', editor);
            })
            .catch(error => {
                console.error('Error during initialization of the editor', error);
            });
    </script>
    @include('common.footer')
</x-app-layout>
