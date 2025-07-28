<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profilePicture', // Asegúrate de que este campo exista en tu migración y sea nullable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    // RELACIÓN DE LOS COMENTARIOS BY JORGE ALDAIR PÉREZ HERNÁNDEZ

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // OBTENER FOTO DE PEFIL BY OSCAR AZAEL FORTINO VELÁZQUEZ
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profilePicture
            ? asset('storage/' . $this->profilePicture)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

}