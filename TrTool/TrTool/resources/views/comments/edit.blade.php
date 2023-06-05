@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Edit Comment</h2>

        <form action="{{ route('communities.posts.comments.update', [$community, $post, $comment]) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="content">Your comment</label>
                <textarea class="form-control" name="content" id="content"
