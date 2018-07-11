<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['channel_id', 'user_id', 'title', 'content'];

    public function channel()
    {
        return $this->belongsTo(\App\Channel::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
