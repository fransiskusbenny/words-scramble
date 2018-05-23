<?php

namespace App;

class Stats
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function durationsOnline()
    {
        $durations = $this->user->games()->sum('durations');

        $minutes = $durations / 60000;

        $hours = floor($minutes / 60);
        $minutes = floor($minutes - ($hours * 60));

        return "$hours hours $minutes minutes";
    }

    public function totalPlay()
    {
        return $this->user->games()->count();
    }

    public function highestScores()
    {
        return $this->user->games()->max('scores');
    }

    public function lastGameTime()
    {
        $lastGame = $this->user->games()->latest()->first();

        return $lastGame ? $lastGame->created_at->diffForHumans() : null;
    }

    public function competitionsCount()
    {
        return $this->user->games()->whereNotNull('competition_id')->count();
    }

    public function totalSolvedWords()
    {
        return $this->user->gameHistories()->get()->unique('solved_word')->count();
    }

    public function totalScores()
    {
        return $this->user->games()->sum('scores');
    }
}