@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Competition Overview</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label font-weight-bold col-sm-3 text-right">Channel:</label>
                            <div  class="col-md-9">
                                <p class="form-control-plaintext">{{ $competition->channel->name }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label font-weight-bold col-sm-3 text-right">Participants Count:</label>
                            <div  class="col-md-9">
                                <p class="form-control-plaintext">{{ $competition->participants()->count() }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label font-weight-bold col-sm-3 text-right">Start at:</label>
                            <div  class="col-md-9">
                                <p class="form-control-plaintext">{{ $competition->start_at->format('d-m-Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label font-weight-bold col-sm-3 text-right">End at:</label>
                            <div  class="col-md-9">
                                <p class="form-control-plaintext">{{ $competition->end_at->format('d-m-Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label font-weight-bold col-sm-3 text-right">Description:</label>
                            <div  class="col-md-9">
                                <p class="form-control-plaintext">{!! nl2br($competition->description) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">Participants List</div>
                    <ul class="list-group">
                        @forelse($competition->participants as $participant)
                        <li class="list-group-item">{{ $participant->name }}</li>
                        @empty
                            <li class="list-group-item">No participants.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection