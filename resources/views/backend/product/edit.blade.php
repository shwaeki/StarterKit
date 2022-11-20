@extends('layouts.app')

@push('title')
    تعديل المنتج
@endpush

@push('pg_btn')
    <a href="{{route('product.index')}}" class="btn btn-sm btn-neutral">جميع المنتجات</a>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('product.update', $product)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <h6 class="heading-small text-muted mb-4">معلومات المنتج</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">عنوان المنتج</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{old('name', $product->name)}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="barcode" class="form-control-label">باركود المنتج</label>
                                        <input type="text" class="form-control" id="barcode" name="barcode"
                                               value="{{old('barcode', $product->barcode)}}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="price" class="form-control-label">سعر المنتج</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                               value="{{old('price', $product->price)}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="cost" class="form-control-label">كلفة المنتج</label>
                                        <input type="number" class="form-control" id="cost" name="cost"
                                               value="{{old('cost', $product->cost)}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="quantity" class="form-control-label">الكمية المتوفرة</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity"
                                               value="{{old('quantity', $product->quantity)}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        {{ Form::label('category_id', 'التصنيف', ['class' => 'form-control-label']) }}
                                        {{ Form::select('category_id', $categories, $product->category_id, [ 'class'=> 'selectpicker form-control', 'required'=> 'required', 'placeholder' => 'اختار التصنيف ...']) }}
                                    </div>
                                </div>


                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="category_id" class="form-control-label"> المورد</label>
                                        {{ Form::select('supplier_id', $suppliers, $product->suppliers_id, [ 'class'=> 'selectpicker form-control', 'required'=> 'required', 'placeholder' => 'اختار المورد ...']) }}
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('featured_image', 'الصورة الاساسية', ['class' => 'form-control-label d-block']) }}
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                              <a id="uploadFile" data-input="thumbnail" data-preview="holder"
                                                 class="btn btn-secondary">
                                                <i class="fa fa-picture-o"></i> اختار صورة
                                              </a>
                                            </span>
                                            <input id="thumbnail" class="form-control d-none" type="text"
                                                   name="featured_image">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    @if ($product->featured_image)
                                        <img alt="Image placeholder" style="max-height: 100px"
                                             src="{{ asset($product->featured_image) }}">
                                    @endif
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="summernote" class="form-control-label">وصف المنتج</label>
                                        <textarea class="form-control" id="summernote" name="description"
                                                  required>{{old('textarea',$product->description)}}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr class="my-4"/>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="status" value="1"
                                               {{ $product->status ? 'checked' : ''}}  class="custom-control-input"
                                               id="status">
                                        <label for="status" class="custom-control-label">الحالة</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="mt-5 btn btn-primary">تعديل</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/summernote-bs4.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script>
        jQuery(document).ready(function () {
            jQuery('#summernote').summernote({
                height: 150,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]

            });
            jQuery('#uploadFile').filemanager('file');
        });
    </script>
@endpush
