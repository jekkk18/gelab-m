@extends('website.layout')

@section('content')
<section>
    <div class="publication-section">
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <h2>{{ $section->title }}</h2>
                </div>

                <div class="publications">
                    <div class="row">
                        @foreach ($posts as $post)
                        @if (json_decode($post->locale_additional) !== null &&
                        !is_array(json_decode($post->locale_additional)) )
                        @if (json_decode($post->locale_additional) !== null &&
                        property_exists(json_decode($post->locale_additional), 'publications') &&
                        json_decode($post->locale_additional) !== null)
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div>
                                <a href="/{{config('config.file_path').json_decode($post->locale_additional)->publications->file}}"  target="blank">
                                    <div class="document">
                                        <div class="document-cover">
                                            @if ($post->translate(app()->getLocale())->images !== null &&
                                            count($post->translate(app()->getLocale())->images) > 0 &&
                                            $post->translate(app()->getLocale())->images[0]['file'] !== null)
                                            <div class="img">
                                                <img src="{{ '/' . config('config.image_path') .  $post->translate(app()->getLocale())->images[0]['file'] }}"
                                                    alt="">
                                            </div>
                                            @else

                                            <img src="/website/img/pubmaincover.jpg" alt="">
                                            @endif

                                            <div class="text">
                                                <div class="text-limit">
                                                    <h3>{{ $post->title }}</h3>
                                                </div>
                                                <div class="pub-description">
                                                    <div class="pad">
                                                        <p>{{ str_limit(strip_tags($post->desc), 800) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="blue-cover"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endif
                        @endif
                        @endforeach



                    </div>

                    {{ $posts->links("website.components.pagination") }}

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
