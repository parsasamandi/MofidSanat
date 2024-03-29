@extends('layouts.main')
@section('title', 'خانه')

@section('head')
	@parent
	<!-- Home -->
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection

@section('content')
	<!-- ======= Header ======= -->
	<header id="header" class="header-transparent">
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
					<li class="menu-has-children"><a href="/product/products">محصولات</a>
						<ul>
							@foreach($categories as $category)
								@if($category->subCategory->count())
									<li class="menu-has-children"><a href="{{ route('products', 
										['category_id' => $category->id]) }}">{{ $category->name }}</a>
										<ul>
											@foreach($category->subcategory as $subcategory)
												<li><a href="{{ route('products', 
												['subcategory_id' => $subcategory->id]) }}">{{ $subcategory->name }}</a></li>
											@endforeach
										</ul>
									</li>
								@else
                                    <li><a href="{{ route('products',
									['category_id' => $category->id ]) }}">{{ $category->name }}</a></li>
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

	<!-- ======= Hero Section ======= -->
	<section style="background: url(/images/{{ $setting_header_image }}) top center;" id="hero">
		<div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
			<h1>{{ $setting_header }}</h1>
			<h2>{{ $setting_sub_header }}</h2>
			<a href="#whyUs" class="btn-get-started">چرا ما</a>
		</div>
	</section>

	<!-- ======= Main ======= -->
	<main id="main">
		<!-- ======= Why Us Section ======= -->
		<section id="whyUs">
			<div class="container" data-aos="fade-up">
				<div class="row whyUs-container text-right">
					@php $colSize = 12 - $setting_about_us_imageSize @endphp
					{{-- Why us Text --}}
					<div class="col-md-{{ $colSize }} content order-lg-1 order-2">
						<h2 class="title">چرا ما</h2>
						 {{-- Why us Box 1 --}}
						 <x-home.aboutUs fontAwesome="fa fa-shopping-bag" :title="$setting_about_us_header" :description="$setting_about_us_text" />
						 {{-- Why us Box 2 --}}
						 <x-home.aboutUs fontAwesome="fas fa-image" :title="$setting_about_us_header2" :description="$setting_about_us_text2" />
						 {{-- Why us Box 3 --}}
						 <x-home.aboutUs fontAwesome="fas fa-chart-area" :title="$setting_about_us_header3" :description="$setting_about_us_text3" />
					</div>
					{{-- Image --}}
					<div style="background: url(/images/{{ $setting_about_us_image }}) center top no-repeat;" class="col-md-{{ $setting_about_us_imageSize }} background" data-aos="fade-left" data-aos-delay="100"></div>
				</div>
			</div>
		</section>

		{{-- About us --}}
		<section id="aboutUs">
			<div class="container" data-aos="fade-up">
				<div class="section-header">
					<h3 class="section-title">درباره ما؟</h3>
				</div>
				<br>
				<div class="row">
					{{-- Image --}}
					<div class="col-md-{{ $setting_why_us_imageSize }}">
						<img class="img_responsive" src="/images/{{ $setting_why_us_image }}" alt="">
					</div>
					{{-- Text --}}
					@php $colSize = 12 - $setting_why_us_imageSize @endphp

					<div class="col-md-{{ $colSize }} mt-3">
						<p class="description aboutUs_description">
							{{ $setting_why_us_text }}
						</p>
					</div>
				</div>
			</div>
		</section>
		
		<!-- ======= Services Section ======= -->
		<section id="services">
			<div class="container" data-aos="fade-up">
				<div class="section-header">
					<h3 class="section-title services">خدمات</h3>
				</div>
				<div class="row">
					{{-- Services --}}
					@foreach($services as $service) 
						<div class="col-lg-4 col-md-6" data-aos="zoom-in">
							<div class="box">
								<div class="icon"><a href=""><i class="{{ $service->font_awesome }}"></i></a></div>
								<h4 class="title"><a href="">{{ $service->title }}</a></h4>
								<p class="description">{{ $service->description }}</p>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</section>

		<!-- ======= Portfolio Section ======= -->
		<section id="portfolio" class="portfolio">
			<div class="container" data-aos="fade-up">
				<div class="section-header">
					<h3 class="section-title">محصولات</h3>
					<p class="section-description">برای دیدن بیشتر محصولات به <a href="/product/products">صفحه محصولات</a> مراجعه کنید</p>
				</div>
				<form method="POST" action="{{ url('product/search') }}" class="form-inline mb-3 search">
					{{ csrf_field() }}
					<input class="form-control my-2" name="search" type="search" placeholder="نام دوره" aria-label="Search">
					<button class="btn btn-primary" type="submit">جستجو</button>
				</form>
				{{-- Products --}}
				<x-products page="home"/>
			</div>
			<div class="container product_button mt-2">
				<a href="{{ url('products') }}" class="btn btn-secondary d-block btn_style">مشاهده تمامی
					محصولات <span class="fa fa-long-arrow-right"></span></a>
			</div>
		</section>

		<!-- ======= Team Section ======= -->
		<section id="team">
			<div class="container" data-aos="fade-up">
				<div class="section-header">
					<h3 class="section-title mb-5 team">Team</h3>
				</div>
				<div class="row">
					@foreach($teams as $team)
						<div class="col-md-{{ $team->size }}">
							<div class="member" data-aos="fade-up" data-aos-delay="100">
								<div class="pic"><img src="/images/{{ $team->media->media_url }}" alt=""></div>
								<h4>{{ $team->name }}</h4>
								<span>{{ $team->responsibility }}</span>
								@if(isset($team->linkedin_address))
									<div class="social">
										<a href="{{ $team->linkedin_address }}"><i class="fa fa-linkedin"></i></a>
									</div>
								@endif
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</section>

		<!-- ======= Contact Section ======= -->
		<section class="text-right" id="contact">
			<div class="container">
				<div class="section-header">
					<h3 class="section-title text-white">تماس با ما</h3>
				</div>
			</div>
			<div class="container mt-5">
				<div class="row justify-content-center">
					{{-- Information --}}
					<div class="col-md-4">
						<div class="info">
							<div>
								<i class="fa fa-map-marker"></i>
								<p>{{ $setting_address }}</p>
							</div>
							<div>
								<i class="fa fa-envelope"></i>
								<p>{{ $setting_email_footer }}</p>
							</div>

							<div>
								<i  class="fa fa-phone"></i>
								<p>{{ $setting_phone_number }}</p>
							</div>
						</div>
						{{-- Instagram --}}
						<div class="social-links text-center">
							<a href="/instagram.com/mofidsanat" class="instagram"><i class="fab fa-instagram"></i></a>
						</div>
					</div>
					{{-- Google Map --}}
					<div class="col-md-7">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3241.089857237054!2d51.27116491525865!3d35.67478938019573!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzXCsDQwJzI5LjIiTiA1McKwMTYnMjQuMSJF!5e0!3m2!1sen!2sae!4v1604570716557!5m2!1sen!2sae"
							height="380" width="100%" frameborder="0" allowfullscreen="true" aria-hidden="false" tabindex="0"></iframe>
					</div>
				</div>
			</div>
		</section>
	</main>

	{{-- Footer --}}
	@include('includes.footer')

	{{-- Back To Top --}}
	<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
@endsection
