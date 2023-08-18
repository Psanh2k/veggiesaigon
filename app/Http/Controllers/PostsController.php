<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostRequest;
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
        return Inertia::render('Posts/Create');
    }

    public function store(CreatePostRequest $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('posts');
            Posts::create([
                'title'     => $request->title,
                'image'     => $image,
                'content'   => $request->content,
            ]);

            return Redirect::route('posts.index');
        }

        return Redirect::back();
    }

    public function edit(Posts $post)
    {
        return Inertia::render('Posts/Edit', compact('post'));
    }

    public function update(Request $request, Posts $post)
    {
        $request->validate([
            'title'         => ['required', 'min:3'],
            'image'         => ['nullable', 'image'],
            'content'       => ['required', 'min:3'],
        ]);

        $dataUpdate = [
            'title'         => $request->title,
            'content'       => $request->content,
        ];

        if ($request->hasFile('image')) {
            Storage::delete($request->image);
            $image = $request->file('image')->store('posts');

            $dataUpdate['image'] = $image;
        }

      
        $post->update($dataUpdate);

        return Inertia::location(route('posts.index'));
    }

    public function destroy(Posts $post)
    {
        Storage::delete($post->image);
        $post->delete();

        return Redirect::back();
    }
}
