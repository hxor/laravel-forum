<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['slug', 'title'];

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }
}
