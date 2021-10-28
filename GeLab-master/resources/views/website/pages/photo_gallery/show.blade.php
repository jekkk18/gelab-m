@extends('website.layout')

@section('content')
<section>
	<div class="photo-inner">
		<div class="container">
			<div class="row">
				<div class="section-title">
					<h2>{{ $post->translate(app()->getLocale())->title }}</h2>
				</div>
				
				@if (isset($post->translate(app()->getLocale())->desc))
					<div class="section-text">
						{!! $post->translate(app()->getLocale())->desc !!} 
					</div>
				@endif

				<div class="all-photo">
					<div class="row">
						@if (isset($post->translate(app()->getLocale())->images))
							@foreach ($post->translate(app()->getLocale())->images as $file)
								<div class="col-lg-4">
									<a href="{{ '/' . config('config.image_path') .  $file['file'] }}" data-fancybox="gallery" data-desc="{{ $file['name'] }}">
										<div class="image">
											<img src="{{ '/' . config('config.image_path') .   $file['file'] }}" alt="">
											@if ($file['name'])
												<div class="description">
													{{ $file['name'] }}
												</div>
											@endif
										</div>
									</a>
								</div>
							@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection