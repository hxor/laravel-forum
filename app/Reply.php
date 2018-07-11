<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'discussion_id', 'user_id', 'content'
    ];

    public function discussion()
    {
        return $this->belongsTo(\App\Discussion::class);
    }

    public function replies()
    {
        return $this->hasMany(\App\Reply::class);
    }
}
