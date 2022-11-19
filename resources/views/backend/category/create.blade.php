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
                    <form action="{{route('category.store')}}" method="POST">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">معلومات التصنيف</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="category_name" class="form-control-label">اسم التصنيف</label>
                                        <input type="text" class="form-control" id="category_name" name="category_name"
                                               value="{{old('category_name')}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <label for="status" class="custom-control-label">الحالة</label>
                                        <input type="checkbox" name="status" value="1" class="custom-control-input"
                                               id="status">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="mt-5 btn btn-primary">اضافة</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
