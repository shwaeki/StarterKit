@extends('layouts.app')
@push('pg_btn')
    @can('update-product')
        <a class="btn btn-info btn-sm m-1" data-toggle="tooltip" data-placement="top" title="Edit product details" href="{{route('product.edit',$product)}}">
            <i class="fa fa-edit" aria-hidden="true"></i> Edit Product
        </a>
    @endcan
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-1">
                            Title
                        </div>
                        <div class="col-sm-3">
                            <strong>{{ $product->name }}</strong>
                        </div>
                        <div class="col-sm-4">
                            @if ($product->featured_image)
                                <a href="{{ asset('storage/'.$product->featured_image) }}" target="_blank">
                                    <img width="150" height="150" class="img-fluid" src="{{ asset('storage/'.$product->featured_image) }}" alt="">
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            Category
                        </div>
                        <div class="col-sm-3">
                            <strong>{{ $product->category->category_name }}</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            Created By
                        </div>
                        <div class="col-sm-3">
                            <strong>{{ $product->user->name }}</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            Body
                        </div>
                        <div class="col-sm-3">
                            <strong>{!! $product->product_body !!}</strong>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-1">
                            Status
                        </div>
                        <div class="col-sm-3">
                            {{ $product->status ? 'Active' : 'Disable'}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
