<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Word extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        static::created(function($model) {
            $model->postCreate();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mode()
    {
        return $this->belongsTo(Mode::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scrambleWords()
    {
        return $this->hasMany(ScrambleWord::class);
    }

    /**
     * @param $value
     * @return string
     */
    public function getWordAttribute($value)
    {
        return strtolower($value);
    }

    /**
     * @return string
     */
    public function shuffle()
    {
        $words = [];

        foreach (explode(' ', $this->text) as $word) {
            $words[] = str_shuffle($word);
        }

        return implode(' ', $words);
    }

    /**
     * @param int $times
     * @return array
     */
    public function shuffles($times = 3)
    {
        return Collection::times($times, function() {
            return $this->shuffle();
        })->unique()->toArray();
    }

    /**
     * @param $query
     * @param $channel
     * @return mixed
     */
    public function scopeHasChannel($query, $channel)
    {
        return $query->whereHas('channel', function($query) use ($channel) {
            $query->where('name', $channel);
        });
    }

    /**
     * @param $query
     * @param $mode
     * @return mixed
     */
    public function scopeHasMode($query, $mode)
    {
        return $query->whereHas('mode', function($query) use ($mode) {
            $query->where('text', $mode);
        });
    }

    protected function postCreate()
    {
        foreach ($this->shuffles() as $text) {
            $this->scrambleWords()->create([
                'text' => $text
            ]);
        }
    }
}
