@extends('layouts.setting')
@section('title','تنظیمات صفحه اصلی')

@section('form')
    {{-- Header --}}
    <div class="row">
        <div class="col-md-12 mb-3">
            <h5>سر تیتر</h5>
            <hr/>
            <input type="file" name="header_image"/>
        </div>
        <div class="col-md-12">
            <img class="image_form mb-3" src="/images/{{ $header_image }}" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-input key="header" name="تیتر" value="{{ $header }}" />
        </div>
        <div class="col-md-6 mb-3">
            <x-input key="sub_header" name="تیتر وسط" value="{{ $sub_header }}" />
        </div>
    </div>
    <!-- Why Us -->
    <div class="row">
        <div class="col-md-12 mt-2">
            <h5>درباره ما</h5>
            <hr>
        </div>
        <div class="col-md-6 mb-3">
            <label for="about_us_image">تصویر درباره ما</label>
            <br>
            <input type="file" name="about_us_image"/>
        </div>
        <div class="col-md-6 mb-3">
            <x-input key="about_us_imageSize" name="اندازه عکس بخش درباره ما" value="{{ $about_us_imageSize }}" />
        </div>
        <div class="col-md-6 mb-3">
            <x-input key="about_us_header" name="تیتر اول بخش درباره ما" value="{{ $about_us_header }}" />
        </div>
        <div class="col-md-6 mb-2">
            <x-textarea key="about_us_text" name="توضیح بخش اول درباره ما" value="{{ $about_us_text }}" />
        </div>
        <div class="col-md-6 mb-2">
            <x-input key="about_us_header2" name="تیتر دوم بخش درباره ما" value="{{ $about_us_header2 }}" />
        </div>
        <div class="col-md-6 mb-2">
            <x-textarea key="about_us_text2" name="توضیح دوم بخش درباره ما" value="{{ $about_us_text2 }}" />
        </div>
        <div class="col-md-6 mb-2">
            <x-input key="about_us_header3" name="تیتر سوم بخش درباره ما" value="{{ $about_us_header3 }}" />
        </div>
        <div class="col-md-6 mb-2">
            <x-textarea key="about_us_text3" name="توضیح سوم بخش درباره ما" value="{{ $about_us_text3 }}" />
        </div>
    </div>
    <!-- Why us? -->
    <div class="row">
        <div class="col-md-12 mt-2">
            <h5>چرا ما</h5>
            <hr>
        </div>
        {{-- Why us text --}}
        <div class="col-md-12 mb-2">
            <x-textarea key="why_us_text" name="نوشته بخش چرا ما" value="{{ $why_us_text }}" />
        </div>
        <div class="col-md-6 mb-2">
            <label for="why_us_image">عکس بخش چرا ما</label>
            <br>
            <input type="file" name="why_us_image"/>
        </div>
        <div class="col-md-6 mb-2">
            <x-input key="why_us_imageSize" name="اندازه عکس بخش چرا ما" value="{{ $why_us_imageSize }}" />
        </div>
    </div>
    <!-- Contact Us -->
    <div class="row">
        <div class="col-md-12 mt-2">
            <h5>تماس با ما</h5>
            <hr>
        </div>
        <div class="col-md-12 mb-2">
            <x-textarea key="address" name="آدرس" value="{{ $address }}" />
        </div>
        <div class="col-md-6 mb-2">
            <x-input key="email" name="ایمیل" value="{{ $email_footer }}" />
        </div>
        <div class="col-md-6 mb-2">
            <x-input key="phone_number" name="تلفن همراه" value="{{ $phone_number }}" />
        </div>
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
