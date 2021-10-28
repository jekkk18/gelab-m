@extends('website.layout')

@section('content')
<section>
	<div class="flag-section">
		<div class="container">
			<div class="row">
				<div class="section-title">
					<h2>{{ $section->title }}</h2>
				</div>

				<div class="text">
					{!! $section->desc !!}
				</div>

				<div class="flags">
					<div class="row">

						@foreach ($posts as $post)
							<div class="col-lg-3 col-md-6 col-12">
								<div class="flag">
									<a href="{{ $post->slug }}" target="_blank">
									@if (isset($post->translate(app()->getLocale())->images) && count($post->translate(app()->getLocale())->images) > 0)
										
										<div class="img">
											<img src="{{ '/' . config('config.image_path') .  $post->translate(app()->getLocale())->images[0]['file'] }}" alt="">
										</div>
									@endif

									<div class="label">
										<span>{{ $post->title }}</span>
									</div>
									</a>
								</div>
							</div>
						@endforeach

						
					</div>
				</div>

				
				{{ $posts->links("website.components.pagination") }}
			</div>
		</div>
	</div>
</section>
@endsection