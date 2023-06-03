@extends('layouts.app')

@section('content')
<h1>{{ $post->title }}</h1>
<p>{{ $post->content }}</p>
<p><a href="{{ route('communities.posts.comments.create', [$community, $post]) }}">Add a Comment</a></p>
@endsection
