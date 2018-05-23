<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScrambleWord extends Model
{
    protected $fillable = [
        'text'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function word()
    {
        return $this->belongsTo(Word::class);
    }

    public function getPointsAttribute()
    {
        return strlen($this->text);
    }
}
