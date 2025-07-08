<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view ('posts/index', [
            'posts' => Post::with('user')->latest()->get(),
        ]);
    }

    // NUEVO MÉTODO: Mostrar post individual con comentarios by Jorge Aldair Pérez Hernández
    public function show(Post $post)
    {
        $post->load(['user', 'parentComments.user', 'parentComments.allReplies.user']);
        return view('posts.show', compact('post'));
    }

    public function store(Request $request){
       
        // Validaciones
       $dataValidates = $request->validate([
            'message' => ['required', 'min:8', 'max:255'],
        ]);

        // $message = request('message');
        // Post::create([
        //     'message' => $message,
        //     'user_id' => auth()->id(),
        // ]);
        $request->user()->posts()->create($dataValidates);
    
        return to_route('posts.index') -> with ('status', __('Post created successfully'));
    }

    public function edit (Post $post){
        // llamar la función de la politica creada
       $this->authorize('update', $post);

        return view ('posts/edit', ['post' => $post]);
    }

    public function update (Request $request, Post $post){

         // llamar la función de la politica creada
       $this->authorize('update', $post);

           $dataValidates = $request->validate([
            'message' => ['required', 'min:8', 'max:255'],
        ]);

        $post->update($dataValidates);
        return to_route('posts.index') -> with ('status', __('Post edited successfully'));
    }

    public function destroy(Post $post){
        $this->authorize('delete', $post);
        $post->delete();
        return to_route('posts.index') -> with ('status', __('Post deleted successfully'));
    }
}