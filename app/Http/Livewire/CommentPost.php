<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;

class CommentPost extends Component
{
    public Photo $photo;
    public $comment = "";
    // public $comments;

    public function comment($id)
    {
        Comment::create([
            'user_id' => Auth::id(),
            'photo_id' => $id,
            'comment' => $this->comment,
        ]);
        $this->comment = "";
    }

    public function delete_comment($id)
    {
        Comment::findOrFail($id)->delete();
    }

    public function render()
    {
        //コメントしたユーザーを取得
        $users = $this->photo->comment()->orderBy('comments.updated_at', 'desc')->get();
        return view('livewire.comment-post', compact('users'));
    }
}
