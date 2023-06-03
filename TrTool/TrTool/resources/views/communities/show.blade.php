@extends('layouts.app')

@section('content')
    <h1>{{ $community->name }}</h1>
    <p>{{ $community->description }}</p>
    <a href="{{ route('communities.edit', $community) }}">Edit</a>
    <!-- Posts will go here -->
@endsection
