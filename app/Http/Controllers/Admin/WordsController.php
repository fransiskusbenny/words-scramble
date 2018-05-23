<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WordsRequest;
use App\Word;

class WordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $words = Word::with('channel', 'mode')
            ->orderBy('text')
            ->paginate();

        return view('admin.words.index', compact('words'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.words.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(WordsRequest $request)
    {
        foreach ($request->words as $word) {
            Word::create([
                'channel_id' => $request->channel,
                'mode_id' => $request->mode,
                'text' => $word['text'],
                'hint' => $word['hint']
            ]);
        }

        return response([]);
    }
}
