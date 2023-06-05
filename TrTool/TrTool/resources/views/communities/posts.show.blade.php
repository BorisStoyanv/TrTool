<h3>Comments</h3>
@foreach($post->comments as $comment)
    <div class="card mt-2">
        <div class="card-body">
            <p>{{ $comment->content }}</p>
        </div>
    </div>
@endforeach
<h3>Add Comment</h3>
<form method="POST" action="{{ route('communities.posts.comments.store', [$community, $post]) }}">
    @csrf
    <div class="form-group">
        <label for="comment-content">Content</label>
        <textarea class="form-control" id="comment-content" name="content" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

