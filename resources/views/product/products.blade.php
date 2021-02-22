@extends('layouts.styleScript')
@section('title','لیست محصولات')

@section('content')
    <!-- Header -->
    <header style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/images/{{ $product_header_image }}') fixed center center;" id="product_header">
        <div class="container text-center text-white">
            <h1 class="font-weight-bold mb-4">{{ $product_header_text }}</h1>
            <p class="lead mb-4">
                {{ $product_header_desc }}
            </p>
        </div>
    </header>

    <!-- Category -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <form method="POST" action="{{ url('product/search') }}" class="form-inline searchBar navbar-brand">
                {{ csrf_field() }}
                <input class="form-control my-1" name="search" type="text" placeholder="نام دوره" aria-label="Search">
                <button class="btn btn-success" type="submit">جستجو</button>
            </form>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            دسته بندی ها
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($cats as $cat)
                                <a class="dropdown-item" href="{{ route('products', ['c_id' => $cat->id]) }}">{{ $cat->name }}</a>
                            @endforeach
                            <!-- <div class="dropdown-divider"></div> -->
                            <!-- <a class="dropdown-item" href="#">Something else here</a> -->
                        </div>
                    </li>
                </ul>
            </div>
           
        </nav>
    <div>

    @if($message = Session::get('faliure'))
        <!-- Error -->
        <section class="mt-3">
            <x-alert type="danger" :message="$message"/>
        </section>
    @else
        <!-- ======= Product Section ======= -->
        <section id="portfolio" class="portfolio bg-primary">
            {{-- Products --}}
            <x-products page="product"/>
            <!-- Pagination  -->
            <ul class="pagination justify-content-center">
                {!! $products->links() !!}
            </ul>
        </section>
        <!-- End Product Section -->
    @endif
@endsection


@section('scripts')
@parent
    <script>
        // Footer
        document.getElementById("footer").style.marginTop = "1.5em";
    </script>
@endsection