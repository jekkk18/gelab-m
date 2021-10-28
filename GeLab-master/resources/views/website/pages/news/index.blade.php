@extends('website.layout')

@section('content')
<section>
	<div class="news-page">
		<div class="container">
			<div class="row">
				<div class="section-title">
					<h2>{{ $section->title }}</h2>
				</div>

				<div class="colums">
					<div class="row">
						@foreach ($posts as $post)
							
						
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="news-post">
								<a href="{{ $post->getFullSlug() }}">
									<div class="cover">
										<img src="/website/img/new-back.png" alt="">

										<div class="blue-cover"></div>
									</div>

									<div class="post-img">
										@if ($post->thumb)
										<img src="{{ thumb($post->thumb) }}" alt="">
										@else
											
										<img src="/default-news.png" alt="">
										@endif
									</div>

									<div class="post-date">
										<span>{{getDates($post->date) }}</span>
									</div>

									<div class="post-description">
										<div class="post-title">
											<h3>{{ $post->title }}</h3>
										</div>

										<div class="post-text">
											<p>{{str_limit(strip_tags($post->desc))}}</p>
										</div>

										<i class="icon-arrow-right"></i>
									</div>
								</a>
							</div>
						</div>
						@endforeach

						

					</div>

				</div>
			</div>
		</div>
	</div>
	{{ $posts->links("website.components.pagination") }}
</section>
@endsection