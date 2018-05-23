<?php

namespace App\Http\Controllers;

use App\Competition;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitions = Competition::upcomingAndOngoing()
            ->with('channel')
            ->withCount('participants')
            ->orderBy('start_at')
            ->get();

        return view('home', compact('competitions'));
    }
}
