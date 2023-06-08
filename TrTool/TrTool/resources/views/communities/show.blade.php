@extends('layouts.app')

@section('content')
<div class="text-white bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 min-h-screen min-w-full flex items-center justify-center">
    <div class="bg-gray-200 dark:bg-gray-800 p-10 rounded-lg shadow-md text-gray-900 dark:text-white w-full sm:w-3/4 lg:w-1/2">
        <h1 class="text-center text-gray-800">{{ $community->name }}</h1>
        <p class="my-4 text-center text-gray-800">{{ $community->description }}</p>
        <div class="flex justify-center space-x-4 my-4">
            <a href="{{ route('communities.edit', $community) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Edit</a>
            <form method="POST" action="{{ route('communities.destroy', $community) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete Community</button>
            </form>
        </div>
        <a href="{{ route('communities.posts.create', $community) }}" class="btn btn-primary bg-green-500 text-white px-4 py-2 rounded mb-4">Add Post</a>

        @foreach($community->posts as $post)
        <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500 mb-4">
            <div class="card-body">
                <h5 class="card-title">
                    <a  href="{{ route('communities.posts.show', [$community, $post]) }}" class="text-gray-800 ">
                        {{ $post->title }}
                    </a>
                </h5>
                <p class="card-text text-black ">{{ $post->content }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
