@extends('website.master')
@section('main')
<div class="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="breadcrumbs">
				@foreach ($breadcrumbs as $breadcrumb)
					@if ($loop->last)
						<i><a href="{{ $breadcrumb['url'] }}" class="current">{{ strtoupper($breadcrumb['name']) }}</a></i>
					@else
						<i><a href="{{ $breadcrumb['url'] }}">{{ strtoupper($breadcrumb['name']) }}/</a></i>
					@endif
				@endforeach
			</div>
		</div>
	</div>
</div>

@yield('content')

<section>
	<div class="text-page-slider">

		<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

			<div class="carousel-inner">

				@foreach ($textPages as $page)
					<div class="carousel-item {{ $loop->first ? 'active' : "" }}">

						<a target="_blank" href="{{ $page->translate(app()->getLocale())->slug }}">
							<img src="/website/img/board-cover.png" alt="" class="slider-cover">
							<img src="{{ image($page->thumb) }}" class="d-block w-100" alt="...">

							<div class="item-space">
								<div class="item-block">
									<div class="item-title">
										
										<h3>{{ $page->translate(app()->getLocale())->title  }}</h3>
									</div>

									<div class="item-text">
										{{ str_limit(strip_tags($page->translate(app()->getLocale())->desc), 400) }}
									</div>
								</div>
							</div>
						</a>
					</div>
				@endforeach

				

			</div>

			<button class="carousel-control-prev icon-left-circle" type="button"
				data-bs-target="#carouselExampleControls" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			</button>
			<button class="carousel-control-next icon-left-circle" type="button"
				data-bs-target="#carouselExampleControls" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
			</button>
		</div>

	</div>
</section>

<section>
	<div class="static-banner">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-5" style="padding: 0;">
					<div class="static-banner-logo">
						<a href="https://europa.eu/european-union/index_en" target="blank"> 
							<img src="/website/img/logo.png" alt="">
						</a>
					</div>
				</div>

				<div class="col-lg-9 col-md-7">
					<div class="static-banner-text">
						{!! settings('disclamer') !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection