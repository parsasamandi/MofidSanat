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
							@foreach($cats as $cat)
								@if($cat->subCat->count())
									<li class="menu-has-children"><a href="{{route('products', ['c_id' => $cat->id])}}">{{ $cat->name }}</a>
										<ul>
											@foreach($cat->subCat as $subCat)
												<li><a href="{{ route('products', ['sc_id' => $subCat->id]) }}">{{ $subCat->name }}</a></li>
											@endforeach
										</ul>
									</li>
								@else
                                    <li><a href="{{route('products', ['c_id' => $cat->c_id ])}}">{{ $cat->name }}</a></li>
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
			<a href="#about" class="btn-get-started">{{ $setting_header_button }}</a>
		</div>
	</section>

	<!-- ======= Main ======= -->
	<main id="main">
		<!-- ======= About Section ======= -->
		<section id="about">
			<div class="container" data-aos="fade-up">
				<div class="row about-container text-right">
					@php $colSize = 12 - $setting_about_us_imageSize @endphp
					{{-- About Us Text --}}
					<div class="col-md-{{ $colSize }} content order-lg-1 order-2">
						<h2 class="title">درباره ما</h2>
						<h3> {{ $setting_about_us_headerText }}</h3>
						 {{-- About Us Box 1 --}}
						 <x-home.aboutUs fontAwesome="fa fa-shopping-bag" :title="$setting_about_us_header" :description="$setting_about_us_text" />
						 {{-- About Us Box 2 --}}
						 <x-home.aboutUs fontAwesome="fas fa-image" :title="$setting_about_us_header2" :description="$setting_about_us_text2" />
						 {{-- About Us Box 3 --}}
						 <x-home.aboutUs fontAwesome="fas fa-chart-area" :title="$setting_about_us_header3" :description="$setting_about_us_text3" />
					</div>
					{{-- Image --}}
					<div style="background: url(/images/{{ $setting_about_us_image }}) center top no-repeat;" class="col-md-{{ $setting_about_us_imageSize }} background" data-aos="fade-left" data-aos-delay="100"></div>
				</div>
			</div>
		</section>

		<!-- ======= Why Us Section ======= -->
		<section id="facts">
			<div class="container" data-aos="fade-up">
				<div class="section-header">
					<h3 class="section-title">چرا ما؟</h3>
				</div>
				<br>
				<div class="row">
					{{-- Image --}}
					<div class="col-md-{{ $setting_why_us_imageSize }}">
						<img class="img_responsive" src="/images/{{ $setting_why_us_image }}" alt="">
					</div>
					{{-- Text --}}
					@php $colSize2 = 12 - $setting_why_us_imageSize @endphp
					<div class="col-md-{{ $colSize2 }} mt-3">
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
					{{-- Header And Text Service 1 --}}
					<x-home.service fontAwesome="fa fa-desktop" :title="$setting_service_header" :description="$setting_service_text" />
					{{-- Header And Text Service 2 --}}
					<x-home.service fontAwesome="fas fa-chart-area" :title="$setting_service_header2" :description="$setting_service_text2" />
					{{-- Header And Text Service 3 --}}
					<x-home.service fontAwesome="fa fa-paper-plane" :title="$setting_service_header3" :description="$setting_service_text3" />
					{{-- Header And Text Service 4 --}}
					<x-home.service fontAwesome="fas fa-image" :title="$setting_service_header4" :description="$setting_service_text4" />
					{{-- Header And Text Service 5 --}}
					<x-home.service fontAwesome="fa fa-road" :title="$setting_service_header5" :description="$setting_service_text5" />
					{{-- Header And Text Service 6 --}}
					<x-home.service fontAwesome="fa fa-shopping-bag" :title="$setting_service_header6" :description="$setting_service_text6" />
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
				<form method="POST" action="{{ route('searchProduct') }}" class="form-inline mb-3 search">
					{{ csrf_field() }}
					<input class="form-control my-2" name="search" type="search" placeholder="نام دوره" aria-label="Search">
					<button class="btn btn-success" type="submit">جستجو</button>
				</form>
				{{-- Products --}}
				<x-products page="home"/>
			</div>
			<div class="container product_button mt-2">
				<a href="/product/products" class="btn btn-secondary d-block btn_style">مشاهده تمامی
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
						<div class="col-md-3">
							<div class="member" data-aos="fade-up" data-aos-delay="100">
								<div class="pic"><img src="/images/{{ $team->image }}" alt=""></div>
								<h4>{{ $team->name }}</h4>
								<span>{{ $team->responsibility }}</span>
								@if(!empty($team->linkedin_address))
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
