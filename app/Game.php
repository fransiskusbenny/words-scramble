<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $guarded = [];


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
        return $this->belongsTo(Mode::class)->withDefault(['text' => 'Competition']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function histories()
    {
        return $this->hasMany(GameHistory::class);
    }

    public function setDurationsAttribute($value)
    {
        $this->attributes['durations'] = $value * 1000;
    }

    public function scopePeriods($query, $period = null)
    {
        switch ($period) {
            case 'today':
                return $query->whereDate('created_at', date('Y-m-d'));
            case 'month':
                return $query->whereMonth('created_at', date('m'));
            case 'year':
                return $query->whereYear('created_at', date('Y'));
            default:
                return $query;
        }
    }
}
