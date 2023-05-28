@extends('layouts.app')

@section('content')
    <h1>Create New Badge</h1>
        <form method="POST" action="{{ route('badges.store') }}">
        @csrf
            <label for="name">Badge Name:</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="description">Badge Description:</label><br>
            <input type="text" id="description" name="description"><br>
            <label for="unicode">Badge Unicode:</label><br>
            <input type="text" id="unicode" name="unicode"><br>
            <input type="submit" value="Create">
        </form>

@endsection
