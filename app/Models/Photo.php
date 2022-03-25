<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsToMany(Photo::class, 'photo_id', 'user_id');
    }
}