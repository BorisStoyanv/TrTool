@extends('layouts.app')

@section('content')
    <h1>{{ $community->name }}</h1>
    <p>{{ $community->description }}</p>
    <a href="{{ route('communities.edit', $community) }}">Edit</a>
    <form method="POST" action="{{ route('communities.destroy', $community) }}">
    @csrf
    @method('DELETE')
    <button type="submit">Delete Community</button>
</form>

<a href="{{ route('communities.posts.create', $community) }}" class="btn btn-primary">Add Post</a>

@foreach($community->posts as $post)
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('communities.posts.show', [$community, $post]) }}">
                    {{ $post->title }}
                </a>
            </h5>
            <p class="card-text">{{ $post->content }}</p>
        </div>
    </div>
@endforeach




@endsection
