<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image_name',
        'title',
        'explanation'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorite()
    {
        return $this->belongsToMany(User::class, 'favorites', 'photo_id', 'user_id');
    }

    //すでにお気に入りに登録しているか
    public function favorite_check()
    {
        return $this->favorite()->where('user_id', Auth::id())->exists();
    }

    public function comment()
    {
        return $this->belongsToMany(User::class, 'comments', 'photo_id', 'user_id')->withPivot('id', 'comment', 'updated_at');
    }
}