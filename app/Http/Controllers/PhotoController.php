<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Photo;
use App\Http\Requests\PostRequest;

class PhotoController extends Controller
{
    // 写真一覧画面
    public function index()
    {
        $photos = Photo::orderby('updated_at', 'desc')->get();  // 更新日時が新しい順に取得
        return view('photo.index', compact('photos'));
    }

    // 写真投稿画面
    public function create()
    {
        return view('photo.create');
    }
    
    // 写真情報の保存処理
    public function store(PostRequest $request)
    {
        $image_path = $request->file('image_name')->store('public/photo/'); // 写真を
        Photo::create([
            'user_id' => Auth::id(),
            'image_name' => basename($image_path),
            'title' => $request->title,
            'explanation' => $request->explanation,
        ]);
        return redirect()->route('photo.index');
    }

    // 写真詳細画面
    public function show($id)
    {
        $photo = Photo::findOrFail($id);
        return view('photo.show', compact('photo'));
    }

    // 写真更新画面
    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        return view('photo.edit', compact('photo'));
    }

    // 写真情報の更新処理
    public function update(Request $request, $id)
    {
        $photo = Photo::findOrFail($id);
        $image_path = $photo->image_name;
        if(!is_Null($request->image_name)){ // 画像が変更されているか
            $image_path = $request->file('image_name')->store('public/photo/');
        }
        $photo->update([
            'image_name' => basename($image_path),
            'title' => $request->title,
            'explanation' => $request->explanation,
        ]);
        return redirect()->route('photo.show', ['photo' => $id]);
    }

    // 写真情報の削除処理
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        Storage::delete('public/photo/'. $photo->image_name);
        $photo->delete();
        return redirect()->route('photo.index');
    }
}
