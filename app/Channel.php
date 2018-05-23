<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['name'];

    public function words()
    {
        return $this->hasMany(Word::class);
    }

    public function competitions()
    {
        return $this->hasMany(Competition::class);
    }
}
