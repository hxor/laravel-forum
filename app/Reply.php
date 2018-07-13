<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Reply extends Model
{
    protected $fillable = [
        'discussion_id', 'user_id', 'content'
    ];

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedByAuth()
    {
        $id = Auth::id();
        $likers = [];

        foreach($this->likes as $like){
            array_push($likers, $like->user_id);
        }

        if(in_array($id, $likers)) {
            return true;
        } else {
            return false;
        }
    }
}
