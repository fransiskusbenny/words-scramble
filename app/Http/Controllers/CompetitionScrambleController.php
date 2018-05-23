<?php

namespace App\Http\Controllers;

use App\Competition;
use App\ScrambleWord;
use App\Word;
use Illuminate\Http\Request;

class CompetitionScrambleController extends Controller
{
    /**
     * @param Competition $competition
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function scramble(Competition $competition)
    {
        $this->authorize('enter-competition', $competition);

        $word = ScrambleWord::whereHas('word', function($query) use ($competition) {
            $query->hasChannel($competition->channel->name);
        })->inRandomOrder()->first();

        $question = [
            'word' => $word->word->text,
            'text' => $word->text,
            'hint' => $word->word->hint,
            'points' => $word->points * 2,
        ];

        return response($question);
    }

    public function check(Competition $competition, Request $request)
    {
        $exists = Word::whereText($request->answer)
            ->whereHas('scrambleWords',
                function($query) use ($request) {
                    $query->whereText($request->text);
                })
            ->exists();

        if ($exists) {
            return response([
                'correct' => true,
            ]);
        }

        return response([
            'correct' => false,
        ]);
    }
}
