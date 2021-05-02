<!DOCTYPE html>
<html lang="en">

@section('stylesheet')
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title')</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">
    <!-- App -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
	<!-- Home -->
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@show

<body>
    <!-- ======= Header ======= -->
    <header id="header">
        <div class="container">
            <div id="logo" class="pull-left">
                <!-- <a href="index.html"><img src="/homeStyle/img/logo.png" alt="مفید صنعت"></a> -->
                <h2><a class="text-white" href="/">مفید صنعت</a></h2>
            </div>
            <nav id="nav-menu-container">
                <ul class="nav-menu dropleft">
                    <li class="menu-active"><a href="/">خانه</a></li>
                    <li><a href="/#about">درباره ما</a></li>
                    <li><a href="/#services">خدمات</a></li>
                    <li class="menu-has-children"><a href="/#portfolio">محصولات</a>
                        <ul>
                            @foreach($categories as $category)
                                @if($category->subcategory->count())
                                    <li class="menu-has-children"><a href="{{route('products', ['c_id' => $cat->id])}}">{{ $category->name }}</a>
                                        <ul>
                                            @foreach($cat->subCat as $subCat)
                                                <li><a href="{{route('products', ['sc_id' => $subcategory->id])}}">{{ $subcategory->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li><a href="{{route('products', ['category_id' => $category->id])}}">{{ $category->name }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="/#contact">تماس با ما</a></li>
                </ul>
            </nav>
            <!-- #nav-menu-container -->
        </div>
    </header>

    <!-- Main -->
    <main id="main">
        @yield('content')
    </main>

    <!-- ======= Footer ======= -->
    @include('includes.footer')

    <!-- Back To Top -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    @section('scripts')
        <!-- Vendor JS Files -->
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/manifest.js') }}"></script>
        {{-- <script src="{{ asset('mainStyle/isotope-layout/isotope.pkgd.min.js') }}"></script> --}}
        <script src="{{ asset('js/isotope.js') }}"></script>
        <script src="{{ asset('mainStyle/aos/aos.js') }}"></script>
        <!-- Template Main JS File -->
        <script src="{{ asset('js/main.js') }}"></script>

    @show
</body>

</html>
