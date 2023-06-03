<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Community;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Community $community)
    {
        return view('communities.posts.create', compact('community'));
    }

    public function store(Request $request, Community $community)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = new Post([
            'title' => $request->title,
            'content' => $request->content,
        ]);        
        $post->user_id = auth()->id();
        $community->posts()->save($post);

        return redirect()->route('communities.show', $community);
    }

    public function show(Community $community, Post $post)
    {
        return view('posts.show', compact('community', 'post'));
    }
    public function edit(Community $community, Post $post)
    {
        return view('posts.edit', compact('community', 'post'));
    }

    public function update(Request $request, Community $community, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('communities.posts.show', [$community, $post]);
    }

    public function destroy(Community $community, Post $post)
    {
        $post->delete();

        return redirect()->route('communities.show', $community);
    }
}
