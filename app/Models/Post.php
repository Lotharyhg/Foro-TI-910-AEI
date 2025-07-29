<?php

namespace App\Models;

use App\Http\Controllers\PostController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'category', // Esta columna almacena la categoría del post by Mitzi 
        'title', // Esta columna almacena el título del post by Michelle Adriana Flores Mora
        'image' // Esta columna almacena la ruta asociada a la imagen del post by Michelle Adriana Flores Mora

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Nueva relación con comentarios BY JORGE ALDAIR PÉREZ HERNÁNDEZ
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // Obtener solo comentarios principales con sus respuestas BY JORGE ALDAR PÉREZ HERNÁNDEZ
    public function parentComments(): HasMany
    {
        return $this->hasMany(Comment::class)
                    ->whereNull('parent_id')
                    ->with('allReplies.user')
                    ->orderBy('created_at', 'asc');
    }

    //Funciones para like y dislike BY JESUS OSWALDO GARCÍA DE LUNA
    public function reacciones()
    {
        return $this->hasMany(PostReacciones::class);
    }

    public function likes()
    {
        return $this->reacciones()->where('is_like', true);
    }

    public function dislikes()
    {
        return $this->reacciones()->where('is_like', false);
    }

}