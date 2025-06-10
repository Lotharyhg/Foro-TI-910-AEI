<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::view('/welcome2', 'welcome') ->name('welcome'); /// Llamar a una sola vista

Route::get('/develop', function(){
    return 'welcome to development';
})->name('develop.index');

Route::get('/developers/{develop}', function($develop){
    if($develop == '4'){
        return redirect()->route('develop.index');
    }
    return 'Developer no access ' . $develop;
});


Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/// rutas personalizadas para el foro de TI

/// Rutas Personalizadas para llamar la función de index y mostrar los posteos
Route::get('/posts',[App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
// Ruta para guardar las publicaciones en la base de datos
Route::post('/posts', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
// Ruta para mostrar el formulario de Editar las publicaciones
Route::get('/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit']) ->name('posts.edit');
// Ruta para guardar la edición de la publicación en la base de datos
Route::patch('/posts/{post}', [App\Http\Controllers\PostController::class, 'update']) ->name('posts.update');
// Ruta para Eliminar las publicaciones
Route::delete('/posts/{post}', [App\Http\Controllers\PostController::class, 'destroy']) ->name('posts.destroy');


require __DIR__.'/auth.php';
