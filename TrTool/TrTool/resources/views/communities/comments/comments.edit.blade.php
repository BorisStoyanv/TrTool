@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('communities.posts.comments.update', [$community, $post, $comment]) }}">
    @csrf
    @method('PUT')
    <textarea name="content">{{ $comment->content }}</textarea>
    <button type="submit">Update Comment</button>
</form>
@endsection
