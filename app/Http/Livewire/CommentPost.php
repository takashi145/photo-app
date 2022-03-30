<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentPost extends Component
{
    public $photo;
    public $comment = "";
    public $comments;

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
        $this->comments = $this->photo->comment()->orderBy('comments.updated_at', 'desc')->get();
        return view('livewire.comment-post');
    }
}
