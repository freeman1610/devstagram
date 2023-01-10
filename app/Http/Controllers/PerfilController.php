<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('perfil.index');
    }
    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);
        $this->validate($request, [
            'username' => [
                'required',
                'unique:users,username,' . auth()->user()->id,
                'min:3',
                'max:20',
                'not_in:editar-perfil'
            ],
            'image' => 'image'
        ]);
        if ($request->image) {
            $image = $request->file('image');
            $nameImage = Str::uuid() . '.' . $image->extension();
            $imageServer = Image::make($image);
            $imageServer->fit(1000, 1000);

            $imagePath = public_path('perfiles') . '/' . $nameImage;

            $imageServer->save($imagePath);
        }
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->image = $nameImage ?? auth()->user()->image ?? null;
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}
