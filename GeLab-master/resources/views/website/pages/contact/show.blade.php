@extends('website.layout')

@section('content')


<section>
	<div class="contact">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="section-title">
						<h2>{{ $post->translate(app()->getLocale())->title }}</h2>
					</div>

					<div class="contact-info">
						{!! $post->translate(app()->getLocale())->desc !!}
					</div>
					<a href="tel:{{ $post->translate(app()->getLocale())->hotline  }}">
						<div class="hotline">

							<span class="icon-phone"><span class="path1"></span><span class="path2"></span></span>

							<b>{{ trans('website.hotline') }} {{ $post->translate(app()->getLocale())->hotline  }}</b>

						</div>
					</a>
				</div>

				<div class="col-lg-6 col-md-6">
					<div class="section-title">
						<h2>{{ $post->translate(app()->getLocale())->second_title }}</h2>
					</div>

					<div class="other-contat-infos">
						<div class="row">

							<div class="col-lg-6 col-md-6">
								<div class="list">
									{!! $post->translate(app()->getLocale())->desc1 !!}
								</div>
							</div>

							<div class="col-lg-6 col-md-6">
								<div class="list">
									{!! $post->translate(app()->getLocale())->desc2 !!}
								</div>
							</div>

							<div class="col-lg-6 col-md-6">
								<div class="list">
									{!! $post->translate(app()->getLocale())->desc3 !!}
								</div>
							</div>

							<div class="col-lg-6 col-md-6">
								<div class="list">
									{!! $post->translate(app()->getLocale())->desc4 !!}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="online-consultation">
				<div class="link">
					{!! $post->translate(app()->getLocale())->online_consiltation_desc !!}
				</div>

				<div class="cover contact-cover">
					<img src="/website/img/contact.png" alt="">
				</div>
			</div>

			<div class="map-part">
				<div class="section-title">
					<h2>{{ trans('website.find_us_on_map') }}</h2>
				</div>

				<div class="map" id="map">
				</div>
			</div>
		</div>
	</div>
</section>


@endsection

@push('scripts')
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgKdVb08BoARnYfw5Ql2nkzlhpBOMoF1k&callback=initMap&libraries=&v=weekly"
async
></script>


<script>
	let map;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: {{ $post->lat1 }}, lng: {{ $post->lng1 }} },
    zoom: 11,
  });
	@if ($post->lat1 !== null && $post->lng1 !== null)
		
		marker = new google.maps.Marker({
            position: { lat: {{ $post->lat1 }}, lng: {{ $post->lng1 }} },
			map: map,
			icon: "/red-pin.png"
        });
	@endif
	@if ($post->lat2 !== null && $post->lng2 !== null)
		
		
        marker = new google.maps.Marker({
            position: { lat: {{ $post->lat2 }}, lng: {{ $post->lng2 }} },
			map: map,
			icon: "/blue-pin.png"
        });

	@endif
	@if ($post->lat3 !== null && $post->lng3 !== null)
		new google.maps.Marker({
			position: { lat: {{ $post->lat3 }}, lng: {{ $post->lng3 }} },
			map: map,
			icon: "/blue-pin.png"
		});
	@endif
	@if ($post->lat4 !== null && $post->lng4 !== null)
		new google.maps.Marker({
			position: { lat: {{ $post->lat4 }}, lng: {{ $post->lng4 }} },
			map: map,
			icon: "/blue-pin.png"
		});
	@endif
	@if ($post->lat5 !== null && $post->lng5 !== null)
		new google.maps.Marker({
			position: { lat: {{ $post->lat5 }}, lng: {{ $post->lng5 }} },
			map: map,
			icon: "/blue-pin.png"
		});
	@endif
	
}
</script>
@endpush