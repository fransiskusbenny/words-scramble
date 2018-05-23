@extends('layouts.app')

@section('content')

    <competition-board
            request-question-endpoint="{{ route('request-question-competition', $competition) }}"
            check-answer-endpoint="{{ route('check-answer-competition', $competition) }}"
            store-game-endpoint="{{ route('games.store') }}"
            index-scores-endpoint="{{ route('competitions.scores.index', $competition) }}"
            update-scores-endpoint="{{ route('competitions.scores.update', $competition) }}"
            :competition="{{ $competition }}"
            :channel="{{ $competition->channel }}"
            inline-template
    >
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <h5 class="card-header">
                            Competitions  - {{ $competition->channel->name }}
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
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h4><strong>Time:</strong>
                                        <small>
                                            <countdown :seconds="{{ $competition->remainingTime() }}" ref="countdown"
                                                       @finished="gameOver"></countdown>
                                        </small>
                                    </h4>

                                    <h4><strong>Score:</strong>
                                        <small v-text="scores"></small>
                                    </h4>

                                    <h4><strong>Correct Words:</strong>
                                        <small v-text="correctWords.length"></small>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">Participants</div>
                                <ul class="list-group" v-for="participant in participantsRanks">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        @{{ participant.name }}
                                        <span class="badge badge-primary badge-pill">@{{ participant.scores }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </competition-board>
@endsection