@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form-competitions
                        endpoint="{{ route('admin.competitions.update', $competition) }}"
                        redirect-to="{{ route('admin.competitions.index') }}"
                        method="patch"
                        :data="{{ $competition }}"
                        :channels="{{ $channels }}"
                >
                    <div class="card-header" slot="title">Edit Competitions</div>
                </form-competitions>
            </div>
        </div>
    </div>
@endsection