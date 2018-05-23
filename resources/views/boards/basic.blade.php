@extends('layouts.app')

@section('content')
    <div class="container">
        <basic-board
                request-question-endpoint="{{ route('request-question', ['channel' => $channel->name, 'mode' => $mode->text]) }}"
                check-answer-endpoint="{{ route('check-answer') }}"
                save-game-endpoint="{{ route('games.store') }}"
                :mode="{{ $mode }}"
                :channel="{{ $channel }}"
                inline-template
        >
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <h5 class="card-header">
                            {{ $mode->text }} - {{ $channel->name }}
                        </h5>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Scramble Word</label>
                                <p class="col-sm-8 lead form-control-plaintext" v-text="word.text"></p>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Hint</label>
                                <p class="col-sm-8 lead form-control-plaintext" v-text="word.hint"></p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <input type="text"
                                       class="form-control"
                                       placeholder="Answer"
                                       v-model="word.answer"
                                       @keyup.enter="check"
                                >
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" @click="check">Check</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body lead">
                            <div class="form-group row">
                                <label class="col-form-label font-weight-bold col-sm-4 text-right">Time:</label>
                                <div  class="col-md-8">
                                    <p class="form-control-plaintext">
                                        <countdown :seconds="60 * 1.2" ref="countdown" @finished="gameOver"></countdown>
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label font-weight-bold col-sm-4 text-right">Scores:</label>
                                <div  class="col-md-8">
                                    <p class="form-control-plaintext" v-text="scores">
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label font-weight-bold col-sm-4 text-right">Correct Words:</label>
                                <div  class="col-md-8">
                                    <p class="form-control-plaintext" v-text="correctWords.length">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </basic-board>
    </div>

@endsection