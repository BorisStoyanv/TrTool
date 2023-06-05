@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Leave a comment on this post</h2>

        <form action="{{ route('communities.posts.comments.store', [$community, $post]) }}" method="post">
            @csrf

            <div class="form-group">
                <label for="content">Your comment</label>
                <textarea class="form-control" name="content" id="content" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

    </div>

@endsection
