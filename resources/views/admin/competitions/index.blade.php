@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header clearfix">
                        <span class="float-left">Competitions List</span>
                        <span class="float-right">
                            <a href="{{ route('admin.competitions.create') }}" class="btn btn-primary btn-sm">Add New</a>
                        </span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderd table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Channels</th>
                                <th class="text-center">Participants Count</th>
                                <th>Start at</th>
                                <th>End at</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($competitions as $competition)
                                <tr>
                                    <td>{{ $competition->channel->name }}</td>
                                    <td class="text-center">{{ $competition->participants()->count() }}</td>
                                    <td>{{ $competition->start_at->format('d-m-Y H:i') }}</td>
                                    <td>{{ $competition->end_at->format('d-m-Y H:i') }}</td>
                                    <td class="text-right">
                                        <table-actions-competitions destroy-endpoint="{{ route('admin.competitions.destroy', $competition) }}" inline-template>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="{{ route('admin.competitions.show', $competition) }}" class="btn btn-info"
                                                   data-toggle="tooltip" data-title="View"
                                                >
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.competitions.edit', $competition) }}" class="btn btn-warning"
                                                   data-toggle="tooltip" data-title="Edit"
                                                >
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger"
                                                        @click="destroy"
                                                        data-toggle="tooltip" data-title="Delete"
                                                >
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </div>
                                        </table-actions-competitions>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($competitions->lastPage() > 1)
                        <div class="card-footer mb-0">
                            {{ $competitions->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection