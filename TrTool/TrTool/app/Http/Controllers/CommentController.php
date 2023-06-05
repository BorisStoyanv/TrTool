<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Community;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Community $community, Post $post)
    {
        return view('comments.create', compact('community', 'post'));
    }

    public function store(Request $request, Community $community, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comment($request->all());
        $comment->user_id = auth()->id();
        $post->comments()->save($comment);

        return redirect()->route('communities.posts.show', [$community, $post]);
    }
    public function edit(Community $community, Post $post, Comment $comment)
    {
        return view('comments.edit', compact('community', 'post', 'comment'));
    }

    public function update(Request $request, Community $community, Post $post, Comment $comment)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment->update($request->all());

        return redirect()->route('communities.posts.show', [$community, $post]);
    }

    public function destroy(Community $community, Post $post, Comment $comment)
    {
        if (auth()->user()->id !== $comment->user_id && auth()->user()->id !== $post->user_id) {
            abort(403);
        }

        $comment->delete();
        return redirect()->route('communities.posts.show', [$community, $post])->with('message', 'Comment deleted successfully');
    }


}
