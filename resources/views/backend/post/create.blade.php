@extends('layouts.app')

@push('title')
    اضافة منشور جديد
@endpush

@push('pg_btn')
    <a href="{{route('post.index')}}" class="btn btn-sm btn-neutral">جميع المنشورات</a>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">ملومات المنشور</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="category_name" class="form-control-label">عنوان المنشور</label>
                                        <input type="text" class="form-control" id="post_title" name="post_title"
                                               value="{{old('post_title')}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="category_id" class="form-control-label"> التصنيف</label>
                                        {{ Form::select('category_id', $categories, null, [ 'class'=> 'selectpicker form-control', 'required'=> 'required', 'placeholder' => 'Select category...']) }}

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
                                        <label for="summernote" class="form-control-label">محتوى المنشور</label>
                                        <textarea class="form-control" id="summernote" name="post_title"
                                                  required>{{old('textarea')}}</textarea>
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
