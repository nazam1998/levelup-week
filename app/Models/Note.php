<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;

class Note extends Model
{
    use HasFactory;

    public function author(){
        return $this->belongsTo(User::class, 'author_id');
    }

    public function likes(){
        return $this->belongsToMany('App\Models\User', 'note_user', 'note_id', 'user_id');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag', 'tag_note', 'note_id', 'tag_id');
    }
}
