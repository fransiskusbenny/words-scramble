<?php

namespace App\Http\Controllers\Admin;

use App\Channel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    public function index()
    {
        $channels = Channel::withCount('words', 'competitions')->paginate();

        return view('admin.channels.index', compact('channels'));
    }

    public function create()
    {
        return view('admin.channels.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:channels,name',
            'words' => 'array|min:1',
            'words.*.text' => 'required|distinct|unique:words,text',
            'words.*.mode' => 'required',
        ]);

        $channel = Channel::create($request->only('name'));

        foreach ($request->words as $word) {
            $channel->words()->create([
                'channel_id' => $channel->id,
                'mode_id' => $word['mode'],
                'text' => $word['text'],
                'hint' => $word['hint'],
            ]);
        }

        return $channel;
    }

    public function show(Channel $channel)
    {
        $words = $channel->words()->orderBy('text')->paginate();
        $competitions = $channel->competitions()->latest()->paginate();

        return view('admin.channels.show', compact('channel', 'words', 'competitions'));
    }

    public function update(Channel $channel, Request $request)
    {
        return tap($channel)
            ->update(
                $request->validate(['name' => 'required|unique:channels,name,' . $channel->id])
            );
    }
}
