<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostsReource;
use App\Http\Resources\SkillResource;
use App\Models\Posts;
use App\Models\Skill;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $posts = PostsReource::collection(Posts::all());

        return Inertia::render('Welcome', compact('posts'));
    }
}
