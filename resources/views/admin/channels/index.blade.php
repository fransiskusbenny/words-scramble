@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header clearfix">
                        <span class="float-left">Channels List</span>
                        <span class="float-right">
                            <a href="{{ route('admin.channels.create') }}" class="btn btn-primary btn-sm">Add New</a>
                        </span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderd table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Channel Name</th>
                                <th class="text-center">Words Count</th>
                                <th class="text-center">Competitions Count</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($channels as $channel)
                                <tr>
                                    <td>{{ $channel->name }}</td>
                                    <td class="text-center">{{ $channel->words_count }}</td>
                                    <td class="text-center">{{ $channel->competitions_count }}</td>
                                    <td>{{ $channel->created_at->format('d-m-Y H:i') }}</td>
                                    <td class="text-right">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.channels.show', $channel) }}" class="btn btn-info" data-toggle="tooltip" data-title="View">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit-{{ $loop->index }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                        <form-edit-channel
                                                id="edit-{{ $loop->index }}"
                                                title="Edit Channel"
                                                endpoint="{{ route('admin.channels.update', $channel) }}"
                                                method="patch"
                                                :data="{{ $channel }}"
                                        >
                                        </form-edit-channel>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($channels->lastPage() > 1)
                        <div class="card-footer mb-0">
                            {{ $channels->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection