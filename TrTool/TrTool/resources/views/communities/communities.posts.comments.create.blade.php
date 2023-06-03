@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('communities.posts.comments.store', [$community, $post]) }}">
    @csrf
    <textarea name="content" placeholder="Comment Content"></textarea>
    <button type="submit">Add Comment</button>
</form>
@endsection
