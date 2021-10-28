@extends('website.layout')

@section('content')
<section>
    <div class="text-page">
        <div class="container">
            <div class="row">
                <div class="
				@if ($post->translate(app()->getLocale())->catalogue !== null && count($post->translate(app()->getLocale())->catalogue) > 0)
				col-lg-9
				@else
				col-lg-12
				@endif
				">
                    <div class="text-side">
                        <div class="section-title">
                            <h2>{{ $post->translate(app()->getLocale())->title }}</h2>
                        </div>

                        <div class="text">
                            {!! $post->translate(app()->getLocale())->text !!}
                        </div>

                        @if($post->translate(app()->getLocale())->form && $post->translate(app()->getLocale())->form == 1)
                        <div class="text-page-form">
							<div class="@if ($post->translate(app()->getLocale())->catalogue !== null && count($post->translate(app()->getLocale())->catalogue) > 0)
								col-lg-12
								@else
								col-lg-9
								@endif
								">
								<div class="title">
									<button class="consultation">{{ trans('website.Consultation') }}</button>
									<div class="line"></div>
								</div>

								<div class="form">
									<form action="" method="POST">
										@csrf
										<div class="inputs">
											<input type="text" placeholder="Name" name="name">
											<input type="email" placeholder="E-mail" name="email">
										</div>

										<textarea id="" cols="30" rows="10" placeholder="Message"
											name="text"></textarea>

										<div class="button">
											<button type="submit">{{ trans('website.SEND') }}</button>
										</div>
									</form>
								</div>
							</div>
                        </div>
                        @endif
                    </div>
                </div>
                @if ($post->translate(app()->getLocale())->catalogue !== null &&
                count($post->translate(app()->getLocale())->catalogue) > 0)


                <div class="col-lg-3">
                    <div class="img-text-page-slider">
                        @if (isset($post->translate(app()->getLocale())->catalogue))
                        @foreach ($post->translate(app()->getLocale())->catalogue as $file)
                        <div class="slide">
                            <a href="{{ '/' . config('config.image_path') .  $file['file'] }}"
                                data-desc="{{ $file['name'] }}" data-fancybox="text">
                                <img src="{{ '/' . config('config.image_path') .  $file['file'] }}" alt="">
                            </a>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="text-page-gallery">
        <div class="container">
            <div class="row">
                @if (count($post->translate(app()->getLocale())->videos) > 1)
                <div class="video-part">
                    <div class="title">
                        <h3>{{ trans('website.videos') }}</h3>
                        <div class="line"></div>
                    </div>

                    <div
                        class="video-slider @if (count($post->translate(app()->getLocale())->videos) == 2) slider-with-align-left @endif">
                        @foreach ($post->translate(app()->getLocale())->videos as $video)
                        @if ($video !== null)
                        <div class="video-slide">
                            <a href="{{ $video }}" data-fancybox="videos">
                                <img src="{{ getVideoImage($video) }}" alt="">
                                <span class="icon-play-button play"></span>
                            </a>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif
                @if (count($post->files) > 0)

                <div class="image-part">
                    <div class="title">
                        <h3>{{ trans('website.images') }}</h3>
                        <div class="line"></div>
                    </div>

                    <div
                        class="image-slider @if (count($post->translate(app()->getLocale())->videos) == 2) slider-with-align-left @endif  @if (count($post->translate(app()->getLocale())->videos) === 1) alignimgleft @endif">
                        @foreach ($post->files as $file)
                        <div class="slide">
                            <a href="{{ '/' . config('config.image_path') .  $file->file }}" data-fancybox="images">
                                <img src="{{ '/' . config('config.image_path') .  $file->file }}" alt="">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
