@extends('layouts.app')



@section('content')

<h1>{{ $post->title }}</h1>

<p>{{ $post->content }}</p>

<p>Posted by {{ $post->user->name }}

    @foreach($post->user->badges as $badge)

    {{ decodeUnicode($badge->unicode) }}

    @endforeach

</p>
@if(auth()->user()->id === $post->user_id)
    <form method="POST" action="{{ route('communities.posts.destroy', ['community' => $post->community, 'post' => $post]) }}">
        @csrf
        @method('DELETE')
        <button  class="red"type="submit">X</button>
    </form>
@endif

<p><a href="{{ route('communities.posts.comments.create', [$community, $post]) }}">Add a Comment</a></p>

@foreach($post->comments->reverse() as $comment)
    <div class="card mt-4">
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
                <button type="submit">X</button>
            </form>
        @endif
    </div>
    
@endforeach
@endsection
