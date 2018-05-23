<?php

namespace App\Http\Controllers\Admin;

use App\Competition;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompetitionRequest;

class CompetitionsController extends Controller
{
    public function index()
    {
        $competitions = Competition::latest()->paginate();

        return view('admin.competitions.index', compact('competitions'));
    }

    public function create()
    {
        return view('admin.competitions.create');
    }

    public function store(CompetitionRequest $request)
    {
        return Competition::create([
            'channel_id' => $request->channel,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'description' => $request->description,
        ]);
    }

    public function show(Competition $competition)
    {
        return view('admin.competitions.show', compact('competition'));
    }

    public function edit(Competition $competition)
    {
        return view('admin.competitions.edit', compact('competition'));
    }


    public function update(Competition $competition, CompetitionRequest $request)
    {
        return tap($competition)->update([
            'channel_id' => $request->channel,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'description' => $request->description,
        ]);
    }

    public function destroy(Competition $competition)
    {
        throw_if(
            $competition->isOngoing() || $competition->isOver(),
            new \Exception('You can not delete this data because it has already started or has ended')
        );

        $competition->delete();

        return response([]);
    }
}
