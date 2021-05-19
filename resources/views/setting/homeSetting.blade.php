@extends('layouts.admin')
@section('content')
    <div class="container-fluid mt-3 right-text">
        {{-- Header --}}
        <h2 class="mt-4">لیست تنظیمات</h2>
        <ol class="breadcrumb mb-4 right-text">
            <li class="breadcrumb-item">صفحه تنظیمات</li>
        </ol>

        {{-- Success or error output --}}
        <span id="form_output"></span>
        
        {{-- Form submittion --}}
        <form id="homeSetting" class="tableBackground" enctype="multipart/form-data">
            @csrf
            <!-- Header -->
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h5>سر تیتر</h5>
                    <hr/>
                    <input type="file" name="header_image"/>
                </div>
                <div class="col-md-12">
                    <img class="image_form mb-3" src="/images/{{ $setting_header_image }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <x-input key="header" name="تیتر" value="{{ $setting_header }}" />
                </div>
                <div class="col-md-4 mb-3">
                    <x-input key="sub_header" name="تیتر وسط" value="{{ $setting_sub_header }}" />
                </div>
                <div class="col-md-4 mb-3">
                    <x-input key="header_button" name="متن دکمه" value="{{ $setting_header_button }}" />
                </div>
            </div>
            <!-- About Us -->
            <div class="row">
                <div class="col-md-12">
                    <h5>درباره ما</h5>
                    <hr>
                    <x-textarea key="about_us_headerText" name="نوشته اول بخش درباره ما" value="{{ $setting_about_us_headerText }}" />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="about_us_image">تصویر درباره ما</label>
                    <br>
                    <input type="file" name="about_us_image"/>
                </div>
                <div class="col-md-6 mb-3">
                    <x-input key="about_us_imageSize" name="اندازه عکس بخش درباره ما" value="{{ $setting_about_us_imageSize }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-input key="about_us_header" name="تیتر اول بخش درباره ما" value="{{ $setting_about_us_header }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-textarea key="about_us_text" name="توضیح بخش اول درباره ما" value="{{ $setting_about_us_text }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-input key="about_us_header2" name="تیتر دوم بخش درباره ما" value="{{ $setting_about_us_header2 }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-textarea key="about_us_text2" name="توضیح دوم بخش درباره ما" value="{{ $setting_about_us_text2 }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-input key="about_us_header3" name="تیتر سوم بخش درباره ما" value="{{ $setting_about_us_header3 }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-textarea key="about_us_text3" name="توضیح سوم بخش درباره ما" value="{{ $setting_about_us_text3 }}" />
                </div>
            </div>
            <!-- Why Us? -->
            <div class="row">
                <div class="col-md-12">
                    <h5>چرا ما؟</h5>
                    <hr>
                    <x-textarea key="why_us_text" name="نوشته بخش چرا ما" value="{{ $setting_why_us_text }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <label for="why_us_image">عکس بخش چرا ما</label>
                    <br>
                    <input type="file" name="why_us_image"/>
                </div>
                <div class="col-md-6 mb-2">
                    <x-input key="why_us_imageSize" name="اندازه عکس بخش چرا ما" value="{{ $setting_why_us_imageSize }}" />
                </div>
            </div>
            <!-- Services -->
            <div class="row">
                <div class="col-md-12 mt-2">
                    <h5>خدمات</h5>
                    <hr>
                </div>
                <div class="col-md-6 mb-2">
                    <x-input key="service_header" name="تیتر اول بخش خدمات" value="{{ $setting_service_header }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-textarea key="service_text" name="توضیح اول بخش خدمات" value="{{ $setting_service_text }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-input key="service_header2" name="تیتر دوم بخش خدمات" value="{{ $setting_about_us_header2 }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-textarea key="service_text2" name="توضیح اول بخش خدمات" value="{{ $setting_service_text2 }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-input key="service_header3" name="تیتر سوم بخش خدمات" value="{{ $setting_service_header3 }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-textarea key="service_text3" rows="2" name="توضیح سوم بخش خدمات" value="{{ $setting_service_text3 }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-input key="service_header4" name="تیتر چهارم بخش خدمات" value="{{ $setting_service_header4 }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-textarea key="service_text4" name="توضیح چهارم بخش خدمات" value="{{ $setting_service_text4 }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-input key="service_header5" name="تیتر پنجم بخش خدمات" value="{{ $setting_service_header5 }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-input key="service_text5" name="توضیح پنجم بخش خدمات" value="{{ $setting_service_text5 }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-input key="service_header6" name="تیتر ششم بخش خدمات" value="{{ $setting_service_header6 }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-input key="service_text6" name="توضیح ششم بخش خدمات" value="{{ $setting_service_text6 }}" />
                </div>
            </div>
            <!-- Contact Us -->
            <div class="row">
                <div class="col-md-12">
                    <h5>تماس با ما</h5>
                    <hr>
                </div>
                <div class="col-md-12 mb-2">
                    <x-textarea key="address" name="آدرس" value="{{ $setting_address }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-input key="email" name="ایمیل" value="{{ $setting_email_footer }}" />
                </div>
                <div class="col-md-6 mb-2">
                    <x-input key="phone_number" name="تلفن همراه" value="{{ $setting_phone_number }}" />
                </div>
            </div>
            {{-- Submit button --}}
            <div class="col-md-12 text-center">
                <button class="btn btn-primary mb-3 mt-3" type="submit">تاييد</button>
            </div>
        </form>
    </div>
@endsection


@section('scripts')
    @parent
    <script>
        // Insert home setting
        $('#homeSetting').on('submit', function(event) {
            event.preventDefault();
            var form_data = new FormData(this);
            form_data.append('file',form_data);

            $.ajax({
                url: "{{ route('setting.storeSetting') }}",
                method: "POST",
                data: form_data,
                dataType: "json",
                contentType: false,
                processData: false,
                cache: false,
                success: function(data) {
                    $('#form_output').html(data.message);
                    $('#homeSetting')[0].reset();
                }
            })
        });
    </script>
@endsection
