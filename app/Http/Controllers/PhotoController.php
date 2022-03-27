<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Photo;
use App\Http\Requests\PostRequest;

class PhotoController extends Controller
{
    public function __construct()
    {
        // 写真一覧画面以外に入る場合にはログインが必要
        $this->middleware('auth')->except(['index']);

        // その写真の投稿者ではないユーザーが編集画面に入った場合に404エラー
        $this->middleware(function($request, $next){
            $id = $request->route()->parameter('photo');
            if(!is_null($id)) {
                $userId = Photo::findOrFail($id)->user->id;
                if((int)$userId !== Auth::id()){
                    abort(404);
                }
            }
            return $next($request);
        })->only('edit');
    }

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
        $image_path = $request->file('image_name')->store('public/photo/');
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
        session()->flash('message', '写真情報を更新しました。');
        return redirect()->route('photo.show', ['photo' => $id]);
    }

    // 写真情報の削除処理
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        Storage::delete('public/photo/'. $photo->image_name);
        $photo->delete();
        session()->flash('delete_message', '写真を削除しました。');
        return redirect()->route('photo.index');
    }
}
