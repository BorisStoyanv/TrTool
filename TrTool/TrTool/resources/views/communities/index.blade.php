@extends('layouts.app')

@section('content')
    <h1>Communities</h1>
    <ul>
    @foreach($communities as $community)
        <li>
            <a href="{{ route('communities.show', $community) }}">
                {{ $community->name }}
            </a>
        </li>
    @endforeach
    </ul>
    <a href="{{ route('communities.create') }}">Create New Community</a>
@endsection
