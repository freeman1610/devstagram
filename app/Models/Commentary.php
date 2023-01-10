<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commentary extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'commentary'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
