<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $guarded = [];

    protected $dates = [
        'start_at', 'end_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function participants()
    {
        return $this->belongsToMany(User::class, 'competition_participants')
            ->withPivot('scores');
    }

    /**
     * @param $value
     */
    public function setStartAtAttribute($value)
    {
        $this->attributes['start_at'] = date('Y-m-d H:i:s', strtotime($value));
    }

    /**
     * @param $value
     */
    public function setEndAtAttribute($value)
    {
        $this->attributes['end_at'] = date('Y-m-d H:i:s', strtotime($value));
    }

    /**
     * @return int
     */
    public function remainingTime()
    {
        return now()->diffInSeconds($this->end_at);
    }

    /**
     * @return bool
     */
    public function isOngoing()
    {
        return now() >= $this->start_at && $this->end_at >= now();
    }

    /**
     * @return bool
     */
    public function isOver()
    {
        return now() > $this->end_at;
    }

    public function isUpcoming()
    {
        return $this->start_at > now();
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_at', '>=', now()->toDateTimeString());
    }

    public function scopeOngoing($query)
    {
        return $query->where('end_at', '>=', now()->toDateTimeString());
    }

    public function scopeUpcomingAndOngoing($query)
    {
        return $query->where('start_at', '>=', now()->toDateTimeString())
            ->orWhere('end_at', '>=', now()->toDateTimeString());
    }

}
