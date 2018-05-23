<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        $games = Game::with('user', 'mode', 'channel')
            ->orderBy('scores', 'desc')
            ->take(10);

        if ($mode = $request->get('mode')) {
            $this->filterMode($games, $mode);
        }

        if ($period = $request->get('period')) {
            $games->periods($period);
        }

        return $games->get()->unique('user_id')->toArray();
    }

    protected function filterMode($games, $mode)
    {
        if ($mode == 'competition') {
            return $games->whereNotNull('competition_id');
        }

        return $games->whereHas('mode', function($query) use ($mode) {
            $query->whereText($mode);
        });
    }
}
