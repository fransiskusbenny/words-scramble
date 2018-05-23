<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function games()
    {
        return $this->hasMany(Game::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function gameHistories()
    {
        return $this->hasManyThrough(GameHistory::class, Game::class)->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function competitions()
    {
        return $this->belongsToMany(Competition::class, 'competition_participants');
    }

    /**
     * @return Stats
     */
    public function stats()
    {
        return new Stats($this);
    }

    public function recordGame(array $attributes)
    {

        $game = $this->games()->create([
            'mode_id' => isset($attributes['mode']) ? $attributes['mode']['id'] : null,
            'competition_id' => isset($attributes['competition']) ? $attributes['competition']['id'] : null,
            'channel_id' => $attributes['channel']['id'],
            'scores' => $attributes['scores'],
            'durations' => $attributes['durations'],
        ]);

        foreach ($attributes['correct_words'] as $word) {
            $game->histories()->create([
                'solved_word' => $word['text'],
                'points' => $word['points']
            ]);
        }

        return $game;
    }

    public function isParticipating($competition)
    {
        return !!$this->competitions->filter(function($data) use ($competition) {
            return $competition->id == $data->id;
        })->count();
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }
}
