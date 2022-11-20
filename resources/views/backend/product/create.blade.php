@extends('layouts.app')

@push('title')
    اضافة منتج جديد
@endpush

@push('pg_btn')
    <a href="{{route('product.index')}}" class="btn btn-sm btn-neutral">جميع المنتجات</a>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">معلومات المنتج</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">عنوان المنتج</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{old('name')}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="barcode" class="form-control-label">باركود المنتج</label>
                                        <input type="text" class="form-control" id="barcode" name="barcode"
                                               value="{{old('barcode')}}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="price" class="form-control-label">سعر المنتج</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                               value="{{old('price',0)}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="cost" class="form-control-label">كلفة المنتج</label>
                                        <input type="number" class="form-control" id="cost" name="cost"
                                               value="{{old('cost',0)}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="quantity" class="form-control-label">الكمية المتوفرة</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity"
                                               value="{{old('quantity',0)}}" required>
                                    </div>
                                </div>


                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="category_id" class="form-control-label"> التصنيف</label>
                                        {{ Form::select('category_id', $categories, null, [ 'class'=> 'selectpicker form-control', 'required'=> 'required', 'placeholder' => 'اختار التصنيف ...']) }}
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="category_id" class="form-control-label"> المورد</label>
                                        {{ Form::select('supplier_id', $suppliers, null, [ 'class'=> 'selectpicker form-control', 'required'=> 'required', 'placeholder' => 'اختار المورد ...']) }}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="thumbnail" class="form-control-label  d-block"> الصورة
                                            الاساسية</label>
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
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="summernote" class="form-control-label">وصف المنتج</label>
                                        <textarea class="form-control" id="summernote" name="description"
                                                  required>{{old('description')}}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr class="my-4"/>
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
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/summernote-bs4.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/js/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script>
        jQuery(document).ready(function () {

            var lfm = function(options, cb) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
                window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
                window.SetUrl = cb;
            };

            // Define LFM summernote button
            var LFMButton = function(context) {
                var ui = $.summernote.ui;
                var button = ui.button({
                    contents: '<i class="note-icon-picture"></i> ',
                    tooltip: 'Insert image with filemanager',
                    click: function() {

                        lfm({type: 'image', prefix: '/filemanager'}, function(lfmItems, path) {
                            lfmItems.forEach(function (lfmItem) {
                                context.invoke('insertImage', lfmItem.url);
                            });
                        });

                    }
                });
                return button.render();
            };

            jQuery('#summernote').summernote({
                height: 150,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['popovers', ['lfm']],
                ],

                buttons: {
                    lfm: LFMButton
                }
            });
            jQuery('#uploadFile').filemanager('file');
        });
    </script>
@endpush
