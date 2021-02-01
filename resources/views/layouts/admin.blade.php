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
    <link href="{{ asset('css/bootstrap-rtl.css') }}" rel="stylesheet">
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
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" rol="button" data-toggle="dropdown" aria-haspopup="true">
                        <i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item text-danger" href="/logout">خروج</a>
                    </div>
                </li>
            </ul>
            <!---------------------------------- SEARCH FORM ---------------------------------->
            {{-- <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="جستجو...." aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form> --}}
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link text-center">
                <i class="fa fa-users"></i>
                <span class="brand-text font-weight-light">مفید صنعت</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            {{-- Products --}}
                            <li class="nav-item">
                                <a href="{{ route('product.list') }}" class="nav-link">
                                    <i class="fa fa-shopping-cart"></i>
                                    <p class="mr-1">
                                        محصولات
                                    </p>
                                </a>
                            </li>
                            {{-- Team --}}
                            <li class="nav-item">
                                <a href="{{ route('team.list') }}" class="nav-link">
                                    <i class="fas fa-user-friends"></i>
                                    <p class="mr-1">
                                        تیم
                                    </p>
                                </a>
                            </li>
                             {{-- Phone Number --}}
                             <li class="nav-item">
                                <a href="{{ route('phoneNumber.list') }}" class="nav-link">
                                    <i class="fas fa-phone"></i>
                                    <p class="mr-1">
                                        شماره همراه
                                    </p>
                                </a>
                            </li>
                             {{-- Admin --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.list') }}" class="nav-link">
                                    <i class="fa fa-users"></i>
                                    <p class="mr-1">
                                        ادمین
                                    </p>
                                </a>
                            </li>
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
                                     <li class="nav-item">
                                        <a href="{{ route('category.list') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>دسته بندی سطح ۱</p>
                                        </a>
                                     </li>
                                     {{-- Sub Categories --}}
                                     <li class="nav-item">
                                        <a href="{{ route('subCategory.list') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>دسته بندی سطح ۲</p>
                                        </a>
                                     </li>
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
                                        <a href="{{ route('aparat.list') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>صفحه آپارات</p>
                                        </a>
                                        {{-- Images --}}
                                        <a href="{{ route('image.list') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>صفحه عکس</p>
                                        </a>
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
                                     <li class="nav-item">
                                        <a href="{{ route('setting.homeSetting') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>تنظیمات صفحه اصلی</p>
                                        </a>
                                     </li>
                                     {{-- Product Setting --}}
                                     <li class="nav-item">
                                        <a href="{{ route('setting.productSetting') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>تنظیمات صفحه محصولات</p>
                                        </a>
                                     </li>
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

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>

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
