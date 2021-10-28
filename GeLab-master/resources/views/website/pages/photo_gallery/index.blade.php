@extends('website.layout')

@section('content')
<div class="photo-gallery">
	<div class="container">
		<div class="row">
			<div class="section-title">
				<h2>{{  $section->title  }}</h2>
			</div>

			<div class="gallery">
				<div class="row">

					@foreach ($posts as $post)
						<div class="col-lg-4">
							<a href="{{ $post->getFullSlug() }}">
								<div class="single-gallery">
									<div class="cover">
										<img src="/website/img/video-cover.png" alt="">
									</div>

									<div class="gallery-img">
										<img src="{{ image($post->thumb) }}" alt="">
									</div>

									<div class="gallery-text">
										<div class="text-limit">
											{{ $post->title }}
										</div>

										<div class="gallery-blue-cover"></div>
									</div>
								</div>
							</a>
						</div>
					@endforeach
					
				</div>

				{{ $posts->links("website.components.pagination") }}
				
			</div>
		</div>
	</div>
</div>

@endsection