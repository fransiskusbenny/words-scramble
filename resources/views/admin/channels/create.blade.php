@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form-create-channel
                        endpoint="{{ route('admin.channels.store') }}"
                        redirect-to="{{ route('admin.channels.index') }}"
                        method="post"
                        :modes="{{ $modes }}"
                >
                </form-create-channel>
            </div>
        </div>
    </div>
@endsection