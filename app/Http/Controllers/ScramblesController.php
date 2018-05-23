<?php

namespace App\Http\Controllers;

use App\ScrambleWord;
use App\Word;
use Illuminate\Http\Request;

class ScramblesController extends Controller
{
    public function scramble(Request $request)
    {
        $word = ScrambleWord::whereHas('word', function($query) use ($request) {
            $query->hasChannel($request->channel)
                ->hasMode($request->mode);
        })->inRandomOrder()->first();

        return response([
            'text' => $word->text,
            'hint' => $word->word->hint,
            'points' => $word->points,
        ]);
    }

    public function check(Request $request)
    {
        $exists = Word::whereText($request->answer)
            ->whereHas('scrambleWords',
                function($query) use ($request) {
                    $query->whereText($request->text);
                })
            ->exists();

        if ($exists) {
            return response(['correct' => true]);
        }

        return response(['correct' => false]);
    }
}
