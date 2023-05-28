@extends('layouts.app')

@section('content')
    <a href="{{ route('badges.create') }}">Create New Badge</a>
    <ul>
        @foreach ($badges as $badge)
        <h1>{{ $badge->name }}</h1>
        <p>{{ $badge->description }}</p>
        <td>{!! $badge->displayBadge() !!}</td>
        <p> ----------------------------------------------------------------------</p>
        <form method="POST" action="{{ route('badges.destroy', $badge) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @endforeach

    </ul>
@endsection
