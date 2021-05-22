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
        
        {{-- Form submission --}}
        <form id="homeSetting" class="tableBackground" enctype="multipart/form-data">
            @csrf

            {{-- Content --}}
            @yield('form')

            {{-- Submit button --}}
            <div class="col-md-12 text-center">
                <button class="btn btn-primary mb-3 mt-3" type="submit">تاييد</button>
            </div>
        </form>
    </div>
@endsection