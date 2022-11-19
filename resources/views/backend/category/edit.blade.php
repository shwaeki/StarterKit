@extends('layouts.app')

@push('title')
    تعديل التصنيف
@endpush

@push('pg_btn')
    <a href="{{route('category.index')}}" class="btn btn-sm btn-neutral">جميع التصنيفات</a>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('category.update', $category)}}" method="POST">
                        @csrf
                        @method('put')
                        <h6 class="heading-small text-muted mb-4">معلومات التصنيف</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="category_name" class="form-control-label">اسم التصنيف</label>
                                        <input type="text" class="form-control" id="category_name" name="category_name"
                                               value="{{old('category_name',$category->category_name)}}" required>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr class="my-4"/>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input name="status" type="hidden" value="0">
                                        <label for="status" class="custom-control-label">الحالة</label>
                                        <input type="checkbox" name="status" value="1" class="custom-control-input"
                                               id="status" {{ $category->status ? 'checked' : ''}}>
                                    </div>
                                </div>
                                @can('update-category')
                                    <div class="col-md-12">
                                        <button type="submit" class="mt-5 btn btn-primary">تعديل</button>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
