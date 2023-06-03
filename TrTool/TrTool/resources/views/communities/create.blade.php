@extends('layouts.app')

@section('content')
    <h1>Create a Community</h1>
    <form method="POST" action="{{ route('communities.store') }}">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <button type="submit">Create</button>
    </form>
@endsection
