<?php

//CREACION DE CONTROLLER PARA COMENTARIOS BY JORGE ALDAIR PÉREZ HERNÁNDEZ

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Post $post)
    {
        $comments = $post->parentComments()
                         ->with('user')
                         ->get();
        return view('comments.index', compact('post', 'comments'));
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'parent_id' => null,
        ]);

        return redirect()->route('posts.show', $post)
                         ->with('success', 'Comentario agregado exitosamente');
    }

    public function reply(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'post_id' => $comment->post_id,
            'parent_id' => $comment->id,
        ]);

        return redirect()->route('posts.show', $comment->post)
                         ->with('success', 'Respuesta agregada exitosamente');
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->route('posts.show', $comment->post)
                         ->with('success', 'Comentario actualizado exitosamente');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $post = $comment->post;
        $comment->delete();

        return redirect()->route('posts.show', $post)
                         ->with('success', 'Comentario eliminado exitosamente');
    }
}