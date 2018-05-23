<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-6 font-weight-bold col-form-label text-right">Total
                Games:</label>
            <div class="col-sm-6">
                <p class="form-control-plaintext">
                    {{ $user->stats()->totalPlay() }}
                </p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-6 font-weight-bold col-form-label text-right">Play
                Hours:</label>
            <div class="col-sm-6">
                <p class="form-control-plaintext">
                    {{ $user->stats()->durationsOnline() }}
                </p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-6 font-weight-bold col-form-label text-right">Highest
                Scores:</label>
            <div class="col-sm-6">
                <p class="form-control-plaintext">
                    {{ $user->stats()->highestScores() }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-6 font-weight-bold col-form-label text-right">Last Game Time:</label>
            <div class="col-sm-6">
                <p class="form-control-plaintext">
                    {{ $user->stats()->lastGameTime() }}
                </p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-6 font-weight-bold col-form-label text-right">Solved
                Words:</label>
            <div class="col-sm-6">
                <p class="form-control-plaintext">
                    {{ $user->stats()->totalSolvedWords() }}
                </p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-6 font-weight-bold col-form-label text-right">Scores
                Collected:</label>
            <div class="col-sm-6">
                <p class="form-control-plaintext">
                    {{ $user->stats()->totalScores() }}
                </p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-6 font-weight-bold col-form-label text-right">Competitions Count:</label>
            <div class="col-sm-6">
                <p class="form-control-plaintext">
                    {{ $user->stats()->competitionsCount() }}
                </p>
            </div>
        </div>
    </div>
</div>