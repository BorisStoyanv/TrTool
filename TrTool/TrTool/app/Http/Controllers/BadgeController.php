<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Badge;

class BadgeController extends Controller
{
    public function index()
    {
        $badges = Badge::all();
        return view('badges.index', ['badges' => $badges]);
    }

    public function create()
    {
        return view('badges.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'unicode' => 'required',
        ]);

        $unicode = str_replace('U+', '', $request->input('unicode'));

        $badge = Badge::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'unicode' => $unicode, 
        ]);

        return redirect()->route('badges.show', $badge);
    }


    public function show(Badge $badge)
    {
        return view('badges.show', ['badge' => $badge]);
    }

    public function edit(Badge $badge)
    {
        return view('badges.edit', ['badge' => $badge]);
    }

    public function update(Request $request, Badge $badge)
    {
        $badge->update($request->all());
        return redirect()->route('badges.index')->with('message', 'Badge updated successfully');
    }

    public function destroy(Badge $badge)
    {
        $badge->delete();
        return redirect()->route('badges.index');
    }
}
