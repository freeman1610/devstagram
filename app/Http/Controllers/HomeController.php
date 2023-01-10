<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    function __invoke()
    {
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->paginate(10);

        return view('home', ['posts' => $posts]);
    }
}
