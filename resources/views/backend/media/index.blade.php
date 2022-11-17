@extends('layouts.app')
@push('styles')
    <style>

        iframe {
            width: 100%;
            height: 700px;
            overflow: hidden;
            border: none;
            box-shadow: 0 0 2rem 0 rgb(136 152 170 / 15%);
            border-radius: 0.375rem;
        }

    </style>
@endpush
@section('content')
    <div class="row" id="file-manager">
        <div class="col-md-12">
            <iframe src="/filemanager"></iframe>
        </div>
    </div>
@endsection