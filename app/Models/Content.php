<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;



class Content extends Model
{
    use HasFactory;


    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function likes()
    {
        return $this->hasMany(content_users::class, 'content_id');
    }

    public function is_liked_by_auth_user()
    {
        $id = Auth::user();

        $likers = array();
        foreach ($this->likes as $like) {
            array_push($likers, $like->user_id);
        }

        if (in_array($id, $likers)) {
            return true;
        } else {
            return false;
        }
    }
}