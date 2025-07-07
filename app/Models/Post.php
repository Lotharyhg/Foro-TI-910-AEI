<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'image' // Esta columna almacena la ruta asociada a la imagen del post by Michelle Adriana Flores Mora

    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
