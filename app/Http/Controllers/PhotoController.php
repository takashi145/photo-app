<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Photo;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\SecondaryCategory;
use Image;
use App\Service\ImageService;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\DB;

class PhotoController extends Controller
{
    public function __construct()
    {
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
    public function index(Request $request)
    {
        if($request['search'] === 'favorite'){ // お気に入り登録した写真一覧
            if(!Auth::check()){
                return redirect()->route('login');
            }
            if(isset($request->category_id)) {
                $photos = Auth::user()->favorite->where('category_id', $request->category_id);
            }else {
                $photos = Auth::user()->favorite;
            }
        }else{
            if(!isset($request->category_id)) {
                $photos = Photo::orderby('updated_at', 'desc')->get();
            }else {
                $photos = Photo::where('category_id', $request->category_id)->orderby('updated_at', 'desc')->get();
            }
        }
        
        $categories = Category::all();

        return view('photo.index', compact('photos', 'categories'));
    }

    // 写真投稿画面
    public function create()
    {
        $categories = Category::all();
        return view('photo.create', compact('categories'));
    }
    
    // 写真情報の保存処理
    public function store(PostRequest $request)
    {   
        $fileNameToStore = ImageService::image_upload($request->image_name);
        Photo::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category,
            'image_name' => $fileNameToStore,
            'title' => $request->title,
            'explanation' => $request->explanation,
        ]);
        session()->flash('message', '写真を投稿しました。');
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
        $categories = Category::all();
        return view('photo.edit', compact('photo', 'categories'));
    }

    // 写真情報の更新処理
    public function update(Request $request, $id)
    {
        $photo = Photo::findOrFail($id);
        if(!is_Null($request->image_name)){ // 画像も変更されているか
            Storage::disk('public')->delete('photo/'.$photo->image_name);
            $fileNameToStore = ImageService::image_upload($request->image_name);
        }else {
            $fileNameToStore = $photo->image_name;
        }
        
        $photo->update([
            'category_id' => $request->category,
            'image_name' => $fileNameToStore,
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
        Storage::disk('public')->delete('photo/'. $photo->image_name);
        $photo->delete();
        session()->flash('delete_message', '写真を削除しました。');
        return redirect()->route('photo.index');
    }
}
