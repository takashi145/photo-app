<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;

class Favorite extends Component
{
    public $photo;
    public $count;

    public function mount()
    {
        $this->count = count($this->photo->favorite);
    }

    public function favorite($id){
        //ログインしていないユーザがお気に入りボタンを押したらログインページにリダイレクト
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $photo = Photo::findOrFail($id);
        Auth::user()->favorite()->attach($photo->id);
        $this->count = count($photo->favorite);
    }

    public function unfavorite($id){
        $photo = Photo::findOrFail($id);
        Auth::user()->favorite()->detach($photo->id);
        $this->count = count($photo->favorite);
    }

    public function render()
    {
        return view('livewire.favorite');
    }
}
