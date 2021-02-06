<!DOCTYPE html>
<html lang="en">

<!-- Head -->
@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="پنل ادمین، کنترل ادمین"> 
    <meta name="keywords" content="ادمین، داشبورد، پنل">  
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- App --}}
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    {{-- Bootstrap rtl --}}
    {{-- <link href="{{ asset('css/bootstrap-rtl.css') }}" rel="stylesheet"> --}}
@show

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" rol="button" data-toggle="dropdown" aria-haspopup="true">
                        <i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item text-danger" href="/logout">خروج</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary">
            <!-- Brand Logo -->
            <a href="/" class="brand-link text-center">
                <i class="fa fa-user"></i>
                <span class="brand-text font-weight-light">{{ Auth::user()->name }}</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            {{-- Products --}}
                            <x-admin.urlAddress text="محصولات" fontAwesome="fa fa-shopping-cart" route="{{ route('product.list') }}" />
                            {{-- Team --}}
                            <x-admin.urlAddress text="تیم" fontAwesome="fas fa-user-friends" route="{{ route('team.list') }}" />
                            {{-- Phone Number --}}
                            <x-admin.urlAddress text="شماره همراه" fontAwesome="fas fa-phone" route="{{ route('phoneNumber.list') }}" />
                            {{-- Admin --}}
                            <x-admin.urlAddress text="ادمین" fontAwesome="fa fa-users" route="{{ route('admin.list') }}" />
                            {{-- Categories --}}
                            <li class="nav-item has-treeview menu-open">
                                <a class="nav-link">
                                     <i class="fa fa-list"></i>
                                     <p class="mr-1">
                                         دسته بندی ها
                                        <i class="right fa fa-angle-left"></i>
                                     </p>
                                 </a>
                                 <ul class="nav nav-treeview">
                                     {{-- Categories --}}
                                    <x-admin.urlAddress text="دسته بندی سطح-۱" fontAwesome="null" route="{{ route('category.list') }}" />
                                     {{-- Sub Categories --}}
                                    <x-admin.urlAddress text="دسته بندی سطح-۲" fontAwesome="null" route="{{ route('subCategory.list') }}" />
                                </ul>
                            </li>
                            {{-- Media --}}
                            <li class="nav-item has-treeview menu-open">
                                <a class="nav-link">
                                    <i class="fas fa-image"></i>
                                    <p class="mr-1">
                                        تصاویر
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        {{-- Aparat --}}
                                        <x-admin.urlAddress text="آپارت" fontAwesome="null" route="{{ route('aparat.list') }}" />
                                        {{-- Images --}}
                                        <x-admin.urlAddress text="عکس" fontAwesome="null" route="{{ route('image.list') }}" />
                                    </li>
                                </ul>
                            </li>
                            {{-- Setting --}}
                            <li class="nav-item has-treeview menu-open">
                                <a class="nav-link">
                                    <i class="fa fa-cog"></i>
                                    <p class="mr-1">
                                        تنظیمات
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                 </a>
                                 <ul class="nav nav-treeview">
                                     {{-- Home Setting --}}
                                     <x-admin.urlAddress text="تنظیمات صفحه اصلی" fontAwesome="null" route="{{ route('setting.homeSetting') }}" />
                                     {{-- Product Setting --}}
                                     <x-admin.urlAddress text="تنظیمات صفحه محصولات" fontAwesome="null" route="{{ route('setting.productSetting') }}" />
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                @yield('content')
            </div>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                <p>
                    تمامی کپی رایت این وبسایت متعلق به مفید صنعت خواهد بود.
                </p>
            </div>
        </footer>
    </div>

    <!-- SCRIPTS -->
    @section('scripts')
        {{-- Select 2 --}}
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('js/admin.js') }}"></script>
        {{-- dataTable --}}
        {{-- <script src="/js/jquery.dataTables.min.js"></script> --}}
        {{-- <script type="text/javascript" src="/js/dataTables.bootstrap4.js"></script> --}}

    @show
</body>
