@extends('website.layout')

@section('content')
<section>
	<div class="news-inner">
		<div class="container">
			<div class="row">
				<div class="section-title">
					<h2>{{ $post->translate(app()->getLocale())->title }}</h2>
				</div>

				<div class="date">
					<span>{{ str_replace("/",".",$post->date) }}</span>
				</div>

				<div class="text">
					{!! $post->translate(app()->getLocale())->text !!}
				</div>


				<div class="news-img-slider">
					@foreach ($post->files as $file)
						
					<div class="news-slide">
						<a href="{{ image($file->file) }}" data-fancybox="news">
							<img src="{{ image($file->file) }}" alt="">
						</a>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>
@endsection