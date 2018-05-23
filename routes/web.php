<?php

Route::get('/', function() {
    return redirect()->home();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::get('basics/boards', 'BoardsController@basic')->name('boards.basic');
    Route::get('competitions/{competition}/boards', 'BoardsController@competitions')->name('boards.competition');

    Route::get('scramble-words', 'ScramblesController@scramble')->name('request-question');
    Route::post('scramble-words/check', 'ScramblesController@check')->name('check-answer');

    Route::get('competitions/{competition}/scramble-words', 'CompetitionScrambleController@scramble')->name('request-question-competition');
    Route::post('competitions/{competition}/scramble-words/check', 'CompetitionScrambleController@check')->name('check-answer-competition');

    Route::get('competitions/{competition}/scores', 'CompetitionsScoresController@index')->name('competitions.scores.index');
    Route::patch('competitions/{competition}/scores', 'CompetitionsScoresController@update')->name('competitions.scores.update');

    Route::get('games', 'GamesController@index')->name('games.index');
    Route::post('games', 'GamesController@store')->name('games.store');

    Route::get('leaderboard', 'LeaderboardController@index')->name('leaderboard.index');

    Route::post('upcoming-competitions/{competition}/join', 'CompetitionsParticipantsController@join')->name('upcoming-competitions.join');

    Route::middleware('admin')->prefix('admin')->namespace('Admin')->name('admin.')->group(function() {
        Route::resource('competitions', 'CompetitionsController');

        Route::get('words', 'WordsController@index')->name('words.index');
        Route::get('words/create', 'WordsController@create')->name('words.create');
        Route::post('words', 'WordsController@store')->name('words.store');

        Route::get('channels', 'ChannelsController@index')->name('channels.index');
        Route::get('channels/create', 'ChannelsController@create')->name('channels.create');
        Route::post('channels', 'ChannelsController@store')->name('channels.store');
        Route::get('channels/{channel}', 'ChannelsController@show')->name('channels.show');
        Route::patch('channels/{channel}', 'ChannelsController@update')->name('channels.update');

    });
});