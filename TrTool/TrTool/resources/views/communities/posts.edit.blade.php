@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('communities.posts.update', [$community, $post]) }}">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ $post->title }}">
    <textarea name="content">{{ $post->content }}</textarea>
    <button type="submit">Update Post</button>
</form>
@endsection
