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

    // NUEVO MÉTODO: Mostrar post individual con comentarios by Jorge Aldair Pérez Hernández
    public function show(Post $post)
    {
        $post->load(['user', 'parentComments.user', 'parentComments.allReplies.user']);
        return view('posts.show', compact('post'));
    }

    public function store(Request $request)
    {
        // Validaciones
        $dataValidates = $request->validate([
            'message' => ['required', 'min:8', 'max:255'],
            'title' => ['required', 'string', 'max:100'], // Validar que el título sea requerido, una cadena y no exceda los 100 caracteres by Michelle Adriana Flores Mora
            'image' => ['nullable', 'image', 'max:2048'], // Validar que sea una imagen y que no pese más de 2MB by Michelle Adriana Flores Mora
        ]);

        // Si hay una imagen, la guardamos by Michelle Adriana Flores Mora
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
            'title' => ['required', 'string', 'max:100'], // Validar que el título sea requerido, una cadena y no exceda los 100 caracteres by Michelle Adriana Flores Mora
            'image' => ['nullable', 'image', 'max:2048'], // Validar que sea una imagen y que no pese más de 2MB by Michelle Adriana Flores Mora
        ]);

        $removedImage = false;
        
        // Si el usuario quiere eliminar la imagen, la eliminamos de la carpeta de almacenamiento by Michelle Adriana Flores Mora
        if ($request->input('remove_image') == '1') {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
                $post->image = null;
                $removedImage = true;  
            }
        }

        // Si hay una nueva imagen, la guardamos y eliminamos la anterior si existe by Michelle Adriana Flores Mora
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $dataValidates['image'] = $request->file('image')->store('posts', 'public');
        }

        // Actualizar el mensaje del post
        $post->message = $dataValidates['message'];
        $post->title = $dataValidates['title']; // Actualizar el título del post by Michelle Adriana Flores Mora

        // Actualizar la imagen si se proporcionó una nueva
        if (array_key_exists('image', $dataValidates)) {
            $post->image = $dataValidates['image'];
        }

        $post->save();

        // Retornar con mensaje apropiado según la acción realizada
        if ($removedImage && !$request->hasFile('image')) {
            return redirect()->route('posts.edit', $post->id)->with('status', __('Image deleted, you can upload a new one.'));
        } else {
            return redirect()->route('posts.index')->with('status', __('Post edited successfully!'));
        }
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        
        // Si el post tiene una imagen, eliminarla de la carpeta de almacenamiento by Michelle Adriana Flores Mora
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        
        $post->delete();
        return to_route('posts.index')->with('status', __('Post deleted successfully'));
    }
}