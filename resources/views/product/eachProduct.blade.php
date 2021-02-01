@extends('layouts.styleScript')
@section('content')


<!-- ======= Breadcrumbs Section ======= -->
<section class="breadcrumbs">
  <div class="container">

    <div class="d-flex justify-content-between align-items-center">
      <h2>جزئیات محصول</h2>
      <ol>
        <li>جزئیات محصول</li>
        <li>محصولات</li>
      </ol>
    </div>

  </div>
</section><!-- Breadcrumbs Section -->

<!-- ======= Portfolio Details Section ======= -->
<section class="portfolio-details">
  <div class="container">
    <div class="portfolio-details-container">
      <div class="owl-carousel portfolio-details-carousel">
        @foreach($product->media as $media)
          @if($media->type == 0)
            <img src="/images/{{ $media->media_url }}">
          @else
            <iframe src="{{ $media->media_url }}" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
          @endif
        @endforeach
      </div>

    <div class="portfolio-info"> 
      <h3>توضیحات محصول</h3>
      <ul>
        <li>
          @if($product->Cat)
            <strong>
              دسته بندی سطح-۱:
            </strong>
            {{ $product->Cat->name }}
          @else
            دسته بندی برای این محصول وجود ندارد
          @endif
        </li>
        <li>
          @if($product->SubCat)
            <strong>دسته بندی سطح-۲:</strong>
            {{ $product->SubCat->name }}
          @else
            دسته بندی سطح دومی برای این محصول وجود ندارد
          @endif
        </li>
        <li>
          <strong>مدل:</strong>
          {{ $product->model }}
        </li>
        <li>
          <strong>هزینه:</strong>
          {{ $product->price }} تومان
        </li>
          <li>
            <strong>شماره تماس:</strong> 
            @foreach($product->phone as $phoneNumber)
              {{ $phoneNumber->number }}/
            @endforeach
          </li>
      </ul>
    </div>
  </div>

  <div class="portfolio-description">
    <h2>{{ $product->name }}</h2>
    <p>
      {{ $product->desc }}
    </p>
  </div>
  </div>
</section>
<!-- End Portfolio Details Section -->
@endsection