<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Discussion extends Model
{
    protected $fillable = ['channel_id', 'user_id', 'slug', 'title', 'content'];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function watchers()
    {
        return $this->hasMany(Watcher::class);
    }

    public function isWatchedByAuth()
    {
        $id = Auth::id();
        $watchers = [];

        foreach($this->watchers as $watcher){
            array_push($watchers, $watcher->user_id);
        }

        if(in_array($id, $watchers)) {
            return true;
        } else {
            return false;
        }
    }

    public function hasBestAnswer()
    {
        $result = false;
        foreach ($this->replies as $reply) {
            if ($reply->is_answered) {
                $result = true;
                break;
            }
        }
        return $result;
    }
}
