@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form-words
                        endpoint="{{ route('admin.words.store') }}"
                        redirect-to="{{ route('admin.words.index') }}"
                        method="post"
                        :channels="{{ $channels }}"
                        :modes="{{ $modes }}"
                >
                    <div class="card-header" slot="title">Add New Words</div>
                </form-words>
            </div>
        </div>
    </div>
@endsection