<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index()
    {
        $communities = Community::all();
        return view('communities.index', compact('communities'));
    }

    public function show(Community $community)
    {
        $posts = $community->posts;
        return view('communities.show', compact('community', 'posts'));
    }

    public function create()
    {
        return view('communities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $community = Community::create(array_merge($request->all(), ['user_id' => Auth::id()]));

        return redirect()->route('communities.show', $community);
    }

    public function edit(Community $community)
    {
        return view('communities.edit', compact('community'));
    }

    public function update(Request $request, Community $community)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $community->update($request->all());

        return redirect()->route('communities.show', $community);
    }

        public function destroy(Community $community)
    {
        $this->authorize('delete', $community);
        $community->delete();

        return redirect()->route('communities.index')->with('status', 'Community deleted successfully.');
    }

}
