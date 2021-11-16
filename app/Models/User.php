<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'description',
        'image',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function notes(){
        return $this->hasMany(Note::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function likes(){
        return $this->belongsToMany('App\Models\Note', 'note_user', 'user_id', 'note_id');
    }

        public function shared(){
            return $this->belongsToMany('App\Models\Note', 'recipient_author_note', 'recipient_id', 'note_id');
        }
}
