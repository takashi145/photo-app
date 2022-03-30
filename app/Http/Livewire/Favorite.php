<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Favorite extends Component
{
    public $photo;
    public $count;

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
        $this->count = $this->photo->favorite()->count();
        return view('livewire.favorite');
    }
}
