<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Commentary;
use Illuminate\Http\Request;

class CommentaryController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        $this->validate($request, [
            'commentary' => 'required|string|max:255'
        ]);
        Commentary::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'commentary' => $request->commentary
        ]);
        return back()->with('mensaje', 'Comentario Realizado');
    }
}
