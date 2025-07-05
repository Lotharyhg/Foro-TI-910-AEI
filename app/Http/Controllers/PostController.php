<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        return view('posts/index', [
            'posts' => Post::with('user')->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {

        // Validaciones
        $dataValidates = $request->validate([
            'message' => ['required', 'min:8', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        // Si hay una imagen, la guardamos
        if ($request->hasFile('image')) {
            $dataValidates['image'] = $request->file('image')->store('posts', 'public');
        }

        $request->user()->posts()->create($dataValidates);

        return to_route('posts.index')->with('status', __('Post created successfully'));
    }

    public function edit(Post $post)
    {
        // llamar la función de la politica creada
        $this->authorize('update', $post);

        return view('posts/edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {

        // llamar la función de la politica creada
        $this->authorize('update', $post);

        $dataValidates = $request->validate([
            'message' => ['required', 'min:8', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        // Si se sube nueva imagen, eliminar la anterior
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $dataValidates['image'] = $request->file('image')->store('posts', 'public');
        }

        if ($request->input('remove_image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
                $dataValidates['image'] = null;
            }
        }

        $post->update($dataValidates);
        return to_route('posts.index')->with('status', __('Post edited successfully'));
    }


    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        // Borrar imagen 
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return to_route('posts.index')->with('status', __('Post deleted successfully'));
    }
}
