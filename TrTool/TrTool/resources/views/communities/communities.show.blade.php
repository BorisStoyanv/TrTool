@extends('layouts.app')

@section('content')
<h1>{{ $community->title }}</h1>
<p>{{ $community->description }}</p>
<p><a href="{{ route('communities.posts.create', $community) }}">Create a Post</a></p>
@endsection
