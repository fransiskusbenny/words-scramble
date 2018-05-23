<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Events\Competitions\UpdateScores;

class CompetitionsScoresController extends Controller
{
    public function index(Competition $competition)
    {
        return $competition->participants->map(function($participant) {
            return [
                'user' => $participant,
                'scores' => $participant->pivot->scores
            ];
        });
    }

    public function update(Competition $competition)
    {
        $user = request('user');

        UpdateScores::dispatch($competition, $user, request('scores'));

        return $competition->participants()->updateExistingPivot($user['id'], request(['scores']));
    }
}
