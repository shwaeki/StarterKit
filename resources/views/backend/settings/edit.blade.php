@extends('layouts.app')
@push('title')
    اعدادات الموقع
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(['route' => 'settings.update', 'files'=>true])}}
            <div class="card mb-5">
                <div class="card-header bg-transparent"><h3 class="mb-0">اعدادات الموقع</h3></div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::label('company_name', 'اسم اشلركة', ['class' => 'form-control-label'])}}
                                    {{ Form::text('company_name', setting('company_name'), ['class'=>"form-control"])}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::label('company_email', 'البريد الاكتروني للشركة', ['class' => 'form-control-label'])}}
                                    {{ Form::text('company_email', setting('company_email'), ['class'=>"form-control"])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::label('company_phone', 'رقم هاتف الشركة', ['class' => 'form-control-label'])}}
                                    {{ Form::text('company_phone', setting('company_phone'), ['class'=>"form-control"])}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::label('company_address', 'عنوان الشركة', ['class' => 'form-control-label'])}}
                                    {{ Form::text('company_address', setting('company_address'), ['class'=>"form-control"])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::label('company_city', 'المدينة', ['class' => 'form-control-label'])}}
                                    {{ Form::text('company_city', setting('company_city'), ['class'=>"form-control"])}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                {{Form::label('company_logo', 'شعار الموقع', ['class' => 'form-control-label'])}}
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                          <a id="uploadFile" data-input="thumbnail" data-preview="holder" class="btn btn-secondary">
                                            <i class="fa fa-picture-o"></i> اختار شعار الموقع
                                          </a>
                                        </span>
                                        @if (setting('company_logo'))
                                            <input id="thumbnail" class="form-control d-none" type="text" value="{{ setting('company_logo') }}" name="company_logo">
                                        @else
                                            <input id="thumbnail" class="form-control d-none" type="text" name="company_logo">
                                        @endif
                                    </div>
                            </div>
                            <div class="col-md-2 text-right">
                                @if (setting('company_logo'))
                                <img alt="Image placeholder"
                                    class="avatar avatar-xl  rounded-circle"
                                    data-toggle="tooltip" data-original-title="{{ setting('company_name') }} Logo"
                                    src="{{ asset(setting('company_logo')) }}">
                                @endif
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card mb-5">
                <div class="card-header bg-transparent"><h4 class="mb-0">اعدادات العرض</h4></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('record_per_page', 'دد العناصر في كل صفحة', ['class' => 'form-control-label'])}}
                                {{ Form::text('record_per_page', setting('record_per_page'), ['class'=>"form-control"])}}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('company_currency_symbol', 'رمز العملة', ['class' => 'form-control-label'])}}
                                {{ Form::text('company_currency_symbol', setting('company_currency_symbol'), ['class'=>"form-control"])}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-header bg-transparent"><h4 class="mb-0">اعدادات اخرى</h4></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::label('default_role', 'ارسال اشعار الى الادمن عند تسجيل حساب جديد', ['class' => 'form-control-label']) }}
                            <div class="custom-control custom-checkbox">
                                {!! Form::hidden('register_notification_email', 0) !!}
                                <input type="checkbox" name="register_notification_email" value="1" {{ setting('register_notification_email') ? 'checked' : ''}} class="custom-control-input" id="register_notification_email">
                                {{ Form::label('register_notification_email', 'Activate', ['class' => 'custom-control-label form-control-label']) }}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('default_role', 'الصلاحيات الافتراضية عند انشاء حساب جديد', ['class' => 'form-control-label']) }}
                                {{ Form::select('default_role', $roles, setting('default_role', null), [ 'class'=> 'selectpicker form-control', 'placeholder' => 'Select role...']) }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('max_login_attempts', 'الحد الأقصى لمحاولات تسجيل الدخول غير الصالحة', ['class' => 'form-control-label'])}}
                                {{ Form::text('max_login_attempts', setting('max_login_attempts'), ['class'=>"form-control"])}}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('lockout_delay', 'قفل التامين (بالدقائق)', ['class' => 'form-control-label'])}}
                                {{ Form::text('lockout_delay', setting('lockout_delay'), ['class'=>"form-control"])}}
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            {!! Form::submit('تحديث الاعدادات', ['class'=> 'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {{Form::close()}}

        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script>
        jQuery(document).ready(function(){
            jQuery('#uploadFile').filemanager('file');
        })
    </script>
@endpush
