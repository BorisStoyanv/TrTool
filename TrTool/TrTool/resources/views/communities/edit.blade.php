@extends('layouts.app')

@section('content')
    <h1>Edit Community</h1>
    <form method="POST" action="{{ route('communities.update', $community) }}">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $community->name }}" required>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required>{{ $community->description }}</textarea>
        <button type="submit">Update</button>
    </form>
@endsection
