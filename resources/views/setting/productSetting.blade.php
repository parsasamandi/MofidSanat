@extends('layouts.admin')
@section('title','تنظیمات صفحه محصولات')

@section('content')
    <div class="container-fluid mt-3 right-text">
        {{-- Header --}}
        <h2 class="mt-4">لیست تنظیمات</h2>
        <ol class="breadcrumb mb-4 right-text">
            <li class="breadcrumb-item">صفحه تنظیمات</li>
        </ol>

        {{-- Success Or Error Output --}}
        <span id="form_output"></span>

        <form id="productSetting" class="tableBackground" enctype="multipart/form-data">
            @csrf
            <br>
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
                <div class="col-md-6 mb-3">
                    <input value="{{ $product_header_text }}" type="text" class="form-control" name="header_text"
                        class="custom-file-input" placeholder="تیتر">
                </div>
                <div class="col-md-6">
                    <textarea rows="4" type="text" class="form-control" name="header_desc" 
                        placeholder="توضیح تیتر">{{ $product_header_description }}</textarea>
                </div>
            </div>

            <div class="col-md-12 mt-3 mb-2 text-center">
                <button class="btn btn-primary" type="submit">تاييد</button>
            </div>
            <br>
        </form>
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