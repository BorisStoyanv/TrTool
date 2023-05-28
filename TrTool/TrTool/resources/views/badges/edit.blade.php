@extends('layouts.app')

@section('content')
    <h1>Edit Badge</h1>
    <form method="POST" action="{{ route('badges.update', $badge) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $badge->name }}" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required>{{ $badge->description }}</textarea>
        </div>
        <div>
            <button type="submit">Update</button>
        </div>
    </form>
@endsection
