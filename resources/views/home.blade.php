@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row mb-5">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">Stats</div>
                            <div class="card-body lead">
                                @include('includes.stats')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <user-games index-games-endpoint="{{ route('games.index') }}"></user-games>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="row mb-5">
                    <div class="col">
                        @include('includes.competitions-list')
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <leaderboard endpoint="{{ route('leaderboard.index') }}" :modes="{{ $modes }}"></leaderboard>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
