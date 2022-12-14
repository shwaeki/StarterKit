@extends('layouts.app')

@push('title')
    اضافة منشور جديد
@endpush

@push('pg_btn')
    @can('create-post')
        <a href="{{ route('post.create') }}" class="btn btn-sm btn-neutral">اضافة منشور جديد</a>
    @endcan
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">جميع المنشورات</h3>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <livewire:post-table/>
                </div>
            </div>
        </div>
    </div>
@endsection
