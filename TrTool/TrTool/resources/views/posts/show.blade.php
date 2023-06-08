@extends('layouts.app')

@section('content')
<div class="text-white bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 min-h-screen min-w-full " >
    <br><br><br><br><br><br><br><br>
<div class="text-black max-w-md mx-auto bg-white shadow-md rounded-lg px-8 py-6 p-50">
    <h1 class="text-2xl font-bold mb-4">{{ $post->title }}</h1>

    <p class="mb-4">{{ $post->content }}</p>

    <p class="mb-4">Posted by {{ $post->user->name }}
        @foreach($post->user->badges as $badge)
            {{ decodeUnicode($badge->unicode) }}
        @endforeach
    </p>

    @if(auth()->user()->id === $post->user_id)
        <form method="POST" action="{{ route('communities.posts.destroy', ['community' => $post->community, 'post' => $post]) }}">
            @csrf
            @method('DELETE')
            <button class="bg-red-500 hover:bg-red-600 py-2 px-4 rounded" type="submit">Delete</button>
        </form>
    @endif

    <p class="mt-6"><a href="{{ route('communities.posts.comments.create', [$community, $post]) }}" class="text-blue-500">Add a Comment</a></p>

    @foreach($post->comments->reverse() as $comment)
        <div class="card mt-4 p-4 bg-gray-100 text-black">
            <p>{{ $comment->content }}</p>
            <small>Comment by {{ $comment->user->name }}
                @foreach($post->user->badges as $badge)
                    {{ decodeUnicode($badge->unicode) }}
                @endforeach
            </small>
            @if(auth()->user()->id === $comment->user_id || auth()->user()->id === $post->user_id)
                <form method="POST" action="{{ route('communities.posts.comments.destroy', ['community' => $comment->post->community, 'post' => $comment->post, 'comment' => $comment]) }}">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 hover:bg-red-600 text-black font-semibold py-1 px-2 rounded mt-2" type="submit">Delete</button>
                </form>
            @endif
        </div>
    @endforeach
</div>
</div>
@endsection
