@extends('website.layout')

@section('content')
<section>
	<div class="video-gallery">
		<div class="container">
			<div class="row">
				<div class="section-title">
					<h2>{{ $section->title }}</h2>
				</div>

				<div class="videos-block">
					<div class="row">
						@foreach ($posts as $post)
							
						<div class="col-xl-4 col-lg-6 col-md-6 col-12">
							<div class="video-div">
								@if (json_decode($post->locale_additional))
								<a href="{{ json_decode($post->locale_additional)->youtube_Link }}"  data-fancybox="gallery">
									<div class="cover">
										<img src="/website/img/video-cover.png" alt="">
									</div>
								
									<div class="video">
										<img src="{{ getVideoImage(json_decode($post->locale_additional)->youtube_Link) }}" alt="">

										<span class="icon-play-button"></span>
									</div>
									<div class="video-title">
										<h3>{{ $post->title }}</h3>
									</div>
									@if ($post->desc !== null)
										<div class="big-text">
											<div class="text-title">
												<h3>{{ $post->title }}</h3>
											</div>
		
											<div class="description">
												{!! str_limit(strip_tags($post->desc), 500) !!}
											</div>
										</div>
									@endif
									
								</a>
								@endif
							</div>
						</div>
										
						@endforeach

						

					</div>

					
					{{ $posts->links("website.components.pagination") }}
					
				</div>
			</div>
		</div>
	</div>
</section>
@endsection