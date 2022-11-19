@extends('layouts.app')

@push('title')
    اضافة منتج جديد
@endpush

@push('pg_btn')
    @can('create-product')
        <a href="{{ route('product.create') }}" class="btn btn-sm btn-neutral">اضافة منتج جديد</a>
    @endcan
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">جميع المنتجات</h3>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <livewire:product-table/>
                </div>
            </div>
        </div>
    </div>
@endsection
