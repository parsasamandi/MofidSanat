@extends('layouts.setting')
@section('title','تنظیمات صفحه اصلی')

@section('form')
    {{-- Header --}}
    <div class="row">
        <div class="col-md-12 mb-3">
            <h5>سر تیتر</h5>
            <hr/>
            <input type="file" name="header_image" />
        </div>
        <div class="col-md-12">
            <img class="image_form mb-3" src="/images/{{ $header_image }}" src="" />
        </div>
    </div>
    <div class="row">
        {{-- Header --}}
        <x-input key="header" placeholder="تیتر" value="{{ $header }}" 
            class="col-md-6 mb-3" />

        {{-- Sub header --}}
        <x-input key="sub_header" placeholder="تیتر وسط" value="{{ $sub_header }}" 
            class="col-md-6 mb-3" />
    </div>
    <!-- Why Us -->
    <div class="row">
        <div class="col-md-12 mt-2">
            <h5>چرا ما</h5>
            <hr>
        </div>

        {{-- Image --}}
        <div class="col-md-6 mb-3">
            <label for="about_us_image">تصویر درباره ما</label>
            <br>
            <input type="file" name="about_us_image" />
        </div>

        {{-- Size --}}
        <x-input key="about_us_imageSize" placeholder="اندازه عکس بخش درباره ما" 
            value="{{ $about_us_imageSize }}" class="col-md-6 mb-3" />

        {{-- Header --}}
        <x-input key="about_us_header" placeholder="تیتر اول بخش درباره ما"
            value="{{ $about_us_header }}" class="col-md-6 mb-3" />

        {{-- Text --}}
        <x-textarea key="about_us_text" placeholder="توضیح بخش اول درباره ما" 
            value="{{ $about_us_text }}" class="col-md-6 mb-2" />

        {{-- Second header --}}
        <x-input key="about_us_header2" placeholder="تیتر دوم بخش درباره ما" 
            value="{{ $about_us_header2 }}" class="col-md-6 mb-2" />

        {{-- Second text --}}
        <x-textarea key="about_us_text2" placeholder="توضیح دوم بخش درباره ما" 
            value="{{ $about_us_text2 }}" class="col-md-6 mb-2" />

        {{-- Third about us header --}}
        <x-input key="about_us_header3" placeholder="تیتر سوم بخش درباره ما" 
            value="{{ $about_us_header3 }}" class="col-md-6 mb-2" />

        {{-- Third about us text --}}
        <x-textarea key="about_us_text3" placeholder="توضیح سوم بخش درباره ما" 
            value="{{ $about_us_text3 }}" class="col-md-6 mb-2" />
    </div>

    {{-- Why us? --}}
    <div class="row">
        <div class="col-md-12 mt-2">
            <h5>چرا ما</h5>
            <hr>
        </div>

        {{-- Why us text --}}
        <x-textarea key="why_us_text" placeholder="نوشته بخش چرا ما" 
            value="{{ $why_us_text }}" class="col-md-12 mb-2" />

        {{-- Why us image --}}
        <div class="col-md-6 mb-2">
            <label for="why_us_image">عکس بخش چرا ما</label>
            <br>
            <input type="file" name="why_us_image"/>
        </div>

        {{-- Why us image size  --}}
        <x-input key="why_us_imageSize" placeholder="اندازه عکس بخش چرا ما" 
            value="{{ $why_us_imageSize }}" class="col-md-6 mb-2" />
    </div>
    <!-- Contact Us -->
    <div class="row">
        <div class="col-md-12 mt-2">
            <h5>تماس با ما</h5>
            <hr>
        </div>
        {{-- Address --}}
        <x-textarea key="address" placeholder="آدرس" 
            value="{{ $address }}" class="col-md-12 mb-2" />

        {{-- Email --}}
        <x-input key="email" placeholder="ایمیل" 
            value="{{ $email_footer }}" class="col-md-6 mb-2" />

        {{-- Phone number --}}
        <x-input key="phone_number" placeholder="تلفن همراه" 
            value="{{ $phone_number }}" class="col-md-6 mb-2" />
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
