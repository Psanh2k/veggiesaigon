<?php

namespace App\Http\Controllers;

use App\Http\Requests\Skills\CreateSkillRequest;
use App\Http\Resources\PostsReource;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;


class PostsController extends Controller
{
    public function index()
    {
        $posts = PostsReource::collection(Posts::all());
        return Inertia::render('Posts/Index', compact('posts'));
    }

    public function create()
    {
        return Inertia::render('Skills/Create');
    }

    public function store(CreateSkillRequest $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('skills');
            Skill::create([
                'name'     => $request->name,
                'image'     => $image,
            ]);

            return Redirect::route('skills.index');
        }

        return Redirect::back();
    }

    public function edit(Skill $skill)
    {
        return Inertia::render('Skills/Edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $image = $request->image;
        $request->validate([
            'name'  => ['required', 'min:3'],
            'image' => ['required', 'image'],
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($request->image);
            $image = $request->file('image')->store('skills');
        }
      
        $skill->update([
            'name'      => $request->name,
            'image'     => $image,
        ]);

        return Inertia::location(route('skills.index'));
    }

    public function destroy(Skill $skill)
    {
        Storage::delete($skill->image);
        $skill->delete();

        return Redirect::back();
    }
}
