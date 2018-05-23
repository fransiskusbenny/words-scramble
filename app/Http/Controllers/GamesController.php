<?php

namespace App\Http\Controllers;

use App\Http\Resources\GamesResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GamesController extends Controller
{
    public function index(Request $request)
    {
        $games = Auth::user()->games();

        if ($sort = $request->get('sort')) {
            list($column, $dir) = explode('|', $sort);

            $games->orderBy($column, $dir);
        } else {
            $games->latest();
        }

        return GamesResource::collection($games->paginate());
    }

    public function store(Request $request)
    {
        return auth()->user()->recordGame($request->all());
    }
}
