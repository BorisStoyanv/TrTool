@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('communities.posts.store', $community) }}" class="max-w-md mx-auto bg-white shadow-md rounded-lg px-8 py-6">
    @csrf
    <div class="mb-4">
        <label for="title" class="block text-gray-700 font-semibold mb-2">Post Title</label>
        <input type="text" name="title" id="title" placeholder="Enter post title" class="w-full border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-2">
    </div>
    <div class="mb-4">
        <label for="content" class="block text-gray-700 font-semibold mb-2">Post Content</label>
        <textarea name="content" id="content" placeholder="Enter post content" class="w-full border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-2 resize-none h-32"></textarea>
    </div>
    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-black font-semibold py-2 px-4 rounded">Create Post</button>
</form>

@endsection
