<?php

namespace App\Http\Controllers;

use App\{
    Channel, Competition, Exceptions\GeneralException, Mode
};
use Illuminate\Http\Request;

class BoardsController extends Controller
{
    public function basic(Request $request)
    {
        return view('boards.basic')->with([
            'channel' => $this->getChannel($request),
            'mode' => $this->getMode($request)
        ]);
    }

    /**
     * @param Competition $competition
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Throwable
     */
    public function competitions(Competition $competition)
    {
        $this->authorize('enter-competition', $competition);

        return view('boards.competition', compact('competition'));
    }

    /**
     * @param Request $request
     * @return Mode
     */
    protected function getMode(Request $request)
    {
        if ($mode = Mode::whereText($request->get('mode'))->first()) {
            return $mode;
        }

        return Mode::inRandomOrder()->first();
    }

    /**
     * @param Request $request
     * @return Channel
     */
    protected function getChannel(Request $request)
    {
        if ($channel = Channel::whereName($request->get('channel'))->first()) {
            return $channel;
        }

        return Channel::inRandomOrder()->first();
    }
}
