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
@show

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
            </ul>

            {{-- Logout --}}
            <form method="POST" class="form-inline ml-3" action="{{ url('logout') }}">
                @csrf
                <div class="input-group input-group-sm">

                    <div class="input-group-append">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle text-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                {{-- Admin --}}
                                <input type="hidden" name="admin" />
                                {{-- Exit --}}
                                <button class="dropdown-item text-danger" type="submit">خروج</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </nav>
        
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary">
            <!-- Brand Logo -->
            <a href="/" class="brand-link text-center">
                <i class="fa fa-user"></i>
                @auth
                    <span class="brand-text font-weight-light">{{ Auth::user()->name }}</span>
                @endauth
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            {{-- Admin --}}
                            <x-admin.urlAddress text="ادمین" fontAwesome="fa fa-users" route="{{ url('admin/list') }}" />

                            {{-- Products --}}
                            <x-admin.urlAddressParent text="محصولات" fontAwesome="fa fa-shopping-cart">
                                <x-slot name="content">
                                    {{-- List --}}
                                    <x-admin.urlAddress text="لیست" fontAwesome="null" route="{{ url('product/list') }}" />
                                    {{-- New Course --}}
                                    <x-admin.urlAddress text="شماره همراه" fontAwesome="fas fa-phone" route="{{ url('phoneNumber/list') }}"  />
                                    {{-- Media --}}
                                    <x-admin.urlAddressParent text="رسانه" fontAwesome="fas fa-image">
                                        <x-slot name="content">
                                            {{-- Aparat --}}
                                            <x-admin.urlAddress text="ویدئو آپارات" fontAwesome="null" route="{{ url('aparat/list') }}" />
                                            {{-- Images --}}
                                            <x-admin.urlAddress text="عکس" fontAwesome="null" route="{{ url('image/list') }}" />
                                        </x-slot>
                                    </x-admin.urlAddressParent>
                                </x-slot>
                            </x-admin.urlAddressParent>

                            {{-- Team --}}
                            <x-admin.urlAddress text="تیم" fontAwesome="fas fa-user-friends" route="{{ url('team/list') }}" />

                            {{-- Categories --}}
                            <x-admin.urlAddressParent text="دسته بندی ها" fontAwesome="fa fa-list">
                                <x-slot name="content">
                                    {{-- Categories --}}
                                    <x-admin.urlAddress text="دسته بندی اول" fontAwesome="null" route="{{ url('category/list') }}" />
                                    {{-- Sub Categories --}}
                                    <x-admin.urlAddress text="دسته بندی دوم" fontAwesome="null" route="{{ url('subCategory/list') }}" />
                                </x-slot>
                            </x-admin.urlAddressParent>

                            {{-- Service --}}
                            <x-admin.urlAddress text="خدمات" fontAwesome="fa fa-id-badge" route="{{ url('service/list') }}" />

                            {{-- Settings--}}
                            <x-admin.urlAddressParent text="تنظیمات" fontAwesome="fa fa-cogs">
                                <x-slot name="content">
                                    {{-- Home --}}
                                    <x-admin.urlAddress text="تنظیمات صفحه اصلی" fontAwesome="null" route="{{ url('setting/homeSetting') }}" />
                                    {{-- Product --}}
                                    <x-admin.urlAddress text="تنظیمات صفحه محصولات" fontAwesome="null" route="{{ url('setting/productSetting') }}" />
                                </x-slot>
                            </x-admin.urlAddressParent>
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
        {{-- App Js --}}
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
        {{-- Ajax Requests --}}
        <script src="{{ asset('js/RequestHandler.js') }}"></script>

        <script>
            // Ajax Setup
            $.ajaxSetup({ processing: true, dataType: "json" });
            // Select2
            $('select').select2({ width:'100%' });
        </script>
    @show
</body>
