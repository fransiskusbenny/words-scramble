@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header clearfix">
                        <span class="float-left">Words List</span>
                        <span class="float-right">
                            <a href="{{ route('admin.words.create') }}" class="btn btn-primary btn-sm">Add New</a>
                        </span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderd table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Text</th>
                                <th>Channel</th>
                                <th>Mode</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($words as $word)
                                <tr>
                                    <td>{{ $word->text }}</td>
                                    <td>{{ $word->channel->name }}</td>
                                    <td>{{ $word->mode->text }}</td>
                                    <td>{{ $word->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($words->lastPage() > 1)
                        <div class="card-footer mb-0">
                            {{ $words->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection