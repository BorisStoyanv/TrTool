@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('communities.posts.store', $community) }}">
    @csrf
    <input type="text" name="title" placeholder="Post Title">
    <textarea name="content" placeholder="Post Content"></textarea>
    <button type="submit">Create Post</button>
</form>
@endsection
