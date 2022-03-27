<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;

class CommentPost extends Component
{
    public $photo;
    public $comment;
    public $comments;

    public function mount()
    {
        $this->comments = $this->photo->comment;
    }

    public function comment($id)
    {
        Comment::create([
            'user_id' => Auth::id(),
            'photo_id' => $id,
            'comment' => $this->comment,
        ]);
        $this->comment = "";
        $this->comments = Photo::findOrFail($id)->comment;
    }

    public function delete_comment($id)
    {
        $comment = Comment::findOrFail($id);
        $photo_id = $comment->photo_id;
        $comment->delete();
        $this->comments = Photo::findOrFail($photo_id)->comment;
    }

    public function render()
    {
        return view('livewire.comment-post');
    }
}
