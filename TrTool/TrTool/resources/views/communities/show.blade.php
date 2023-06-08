@extends('layouts.app')

@section('content')

    <h1>{{ $community->name }}</h1>
    <p>{{ $community->description }}</p>
    <a href="{{ route('communities.edit', $community) }}">Edit</a>
    <form method="POST" action="{{ route('communities.destroy', $community) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Community</button>
    </form>

    <a href="{{ route('communities.posts.create', $community) }}" class="btn btn-primary">Add Post</a>

    @foreach($community->posts as $post)
    <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
        <div class="card-body">
            <h5 class="card-title">
                <a  href="{{ route('communities.posts.show', [$community, $post]) }}">
                    {{ $post->title }}
                </a>
            </h5>
            <p class="card-text text-white">{{ $post->content }}</p>
        </div>
    </div>
    @endforeach

@endsection
