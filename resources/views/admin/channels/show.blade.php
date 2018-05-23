@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Channel Overview</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label font-weight-bold col-sm-3 text-right">Channel:</label>
                            <div  class="col-md-9">
                                <p class="form-control-plaintext">{{ $channel->name }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label font-weight-bold col-sm-3 text-right">Words Count:</label>
                            <div  class="col-md-9">
                                <p class="form-control-plaintext">{{ $channel->words()->count() }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label font-weight-bold col-sm-3 text-right">Competitions at:</label>
                            <div  class="col-md-9">
                                <p class="form-control-plaintext">{{ $channel->competitions()->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header">Words List</div>
                <ul class="list-group">
                    @forelse($words as $word)
                        <li class="list-group-item">{{ $word->text }}</li>
                    @empty
                        <li class="list-group-item">No records found.</li>
                    @endforelse
                </ul>
                @if($words->lastPage() > 1)
                    <div class="card-footer mb-0">
                        {{ $words->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection