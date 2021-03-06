<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;

class Favorite extends Component
{
    public Photo $photo;

    public function favorite(){
        //ログインしていないユーザがお気に入りボタンを押したらログインページにリダイレクト
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $this->photo->favorite()->attach(Auth::id());
    }

    public function unfavorite(){
        $this->photo->favorite()->detach(Auth::id());
    }

    public function render()
    {
        $count = $this->photo->favorite()->count();
        return view('livewire.favorite', compact('count'));
    }
}
