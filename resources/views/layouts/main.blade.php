<!DOCTYPE html>
<html lang="en">    
    {{-- Header --}}
    @section('head')
        <title>{{ config('app.name', 'MofidSanat') }}</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="description" content="مفید صنعت، شرکتی پیشرو در زمینه لیبل زدن">
        <meta name="keywords" description="مفید صنعت">
        <!-- App -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @show

    <body>
        @yield('content')
    </body>

    {{-- Scripts --}}
    @section('scripts')
        {{-- App --}}
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/manifest.js') }}"></script> 
        {{-- Isotope	 --}}
        <script src="{{ asset('js/isotope.js') }}"></script>
        <!-- Main -->
        <script src="{{ asset('js/main.js') }}"></script>
    @show

</html>