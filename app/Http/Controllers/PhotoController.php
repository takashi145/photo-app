<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;
use App\Http\Requests\PostRequest;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::all();
        return view('photo.index', compact('photos'));
    }

    public function create()
    {
        return view('photo.create');
    }
    
    public function store(PostRequest $request)
    {
        $image_path = $request->file('image_name')->store('public/photo/');
        Photo::create([
            'user_id' => Auth::id(),
            'image_name' => basename($image_path),
            'title' => $request->title,
            'explanation' => $request->explanation,
        ]);
        return redirect()->route('photo.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
