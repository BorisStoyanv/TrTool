@extends('layouts.app')

@section('content')
<div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    <h1 class="text-white">Communities</h1>
    <div class="flex flex-col justify-center items-center space-y-5">
        <div>
            <ul>
            @foreach($communities as $community)
                <li>
                    <a href="{{ route('communities.show', $community) }}">
                        {{ $community->name }}
                    </a>
                </li>
            @endforeach
            </ul>
        </div>
        <div>
            <a href="{{ route('communities.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Create New Community</a>
        </div>
    </div>
</div>
@endsection
