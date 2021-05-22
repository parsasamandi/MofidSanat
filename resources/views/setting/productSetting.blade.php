@extends('layouts.setting')
@section('title','تنظیمات صفحه محصولات')

@section('form')
    <div class="row">
        {{-- Image --}}
        <div class="col-md-12 mb-3">
            <h5>تصویر پشت زمینه</h5>
            <hr/>
            <input type="file" name="header_image"/>
        </div>
        <div class="col-md-12">
            <img class="image_form mb-3" src="/images/{{ $product_header_image }}" />
        </div>
    </div>
    <div class="row">
        {{-- Title --}}
        <div class="col-md-6 mb-3">
            <input value="{{ $product_header_text }}" type="text" class="form-control" name="header_text"
                class="custom-file-input" placeholder="تیتر">
        </div>
        {{-- Title description --}}
        <div class="col-md-6">
            <textarea rows="4" type="text" class="form-control" name="header_desc" 
                placeholder="توضیح تیتر">{{ $product_header_description }}</textarea>
        </div>
    </div>
@endsection


@section('scripts')
    @parent
    <script>
        $('#productSetting').on('submit', function(event) {
            event.preventDefault();
            var form_data = new FormData(this);
            form_data.append('file', form_data);
            $.ajax({
                url: "{{ route('setting.storeProduct') }}",
                method: "POST",
                data: form_data,
                dataType: "json",
                contentType: false,
                processData: false,
                cache: false,
                success: function(data) {
                    $('#form_output').html(data.success);
                    $('#productSetting')[0].reset();
                }
            })
        });
    </script>
@endsection