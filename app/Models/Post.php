<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'descripcion',
        'image',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class)->select([
            'name',
            'username'
        ]);
    }
    public function commentary()
    {
        return $this->hasMany(Commentary::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
