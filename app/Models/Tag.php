<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function notes(){
        return $this->belongsToMany('App\Models\Note', 'tag_note', 'tag_id', 'note_id');
    }
}
