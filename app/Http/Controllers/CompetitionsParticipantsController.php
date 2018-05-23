<?php

namespace App\Http\Controllers;

use App\Competition;

class CompetitionsParticipantsController extends Controller
{
    public function join(Competition $competition)
    {
        $competition->participants()->toggle(auth()->user());

        return response(['is_join' => auth()->user()->isParticipating($competition)]);
    }
}
