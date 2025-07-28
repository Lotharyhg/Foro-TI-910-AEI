<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostReacciones;
use App\Models\PostReaction;
use Illuminate\Http\Request;

class PostReactionController extends Controller
{
     public function react(Post $post, Request $request)
    {
        $request->validate([
            'is_like' => 'required|boolean',
        ]);

        PostReacciones::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'post_id' => $post->id,
            ],
            [
                'is_like' => $request->is_like,
            ]
        );

        return back();
    }
}
