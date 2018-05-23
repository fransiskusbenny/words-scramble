@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form-competitions
                        endpoint="{{ route('admin.competitions.store') }}"
                        redirect-to="{{ route('admin.competitions.index') }}"
                        method="post"
                        :channels="{{ $channels }}"
                >
                    <div class="card-header" slot="title">Add New Competitions</div>
                </form-competitions>
            </div>
        </div>
    </div>
@endsection