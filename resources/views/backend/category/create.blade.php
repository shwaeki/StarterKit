@extends('layouts.app')

@push('title')
   اضافة تصنيف جديد
@endpush

@push('pg_btn')
    <a href="{{route('category.index')}}" class="btn btn-sm btn-neutral">جميع التصنيفات</a>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    {!! Form::open(['route' => 'category.store']) !!}
                    <h6 class="heading-small text-muted mb-4">معلومات التصنيف</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('category_name', 'اسم التصنيف', ['class' => 'form-control-label']) }}
                                    {{ Form::text('category_name', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="status" value="1" class="custom-control-input"
                                           id="status">
                                    {{ Form::label('status', 'الحالة', ['class' => 'custom-control-label']) }}
                                </div>
                            </div>
                            <div class="col-md-12">
                                {{ Form::submit('اضافة', ['class'=> 'mt-5 btn btn-primary']) }}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
