@extends($activeTemplate.'layouts.frontend')
@section('content')
    @php
        $banner_content = getContent('banner.content', true);
    @endphp
    <section class="banner-section bg-overlay-black bg_img"
             data-background="{{ getImage('assets/images/frontend/banner/' . @$banner_content->data_values->background_image, '1778x755') }}">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="banner-content">
                        <span class="sub-title">{{ __(@$banner_content->data_values->heading) }}</span>
                        <h1 class="title text-white">{{ __(@$banner_content->data_values->sub_heading) }}</h1>
                        <div class="banner-btn">
                            <a href="{{ @$banner_content->data_values->button_1_link }}"
                               class="btn--base">{{ __(@$banner_content->data_values->button_1) }}</a>
                            <a href="{{ @$banner_content->data_values->button_2_link }}" class="btn--base active"><i
                                    class="las la-plus"></i> {{ __(@$banner_content->data_values->button_2) }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="banner-slider">
                        <div class="swiper-wrapper">
                            @foreach($sliders as $slider)
                                <div class="swiper-slide">
                                    <div class="movie-item">
                                        <div class="movie-thumb">
                                            <img src="{{ getImage(getFilePath('item_portrait').'/'.@$slider->item->image->portrait) }}"
                                                 alt="movie">
                                            <div class="movie-thumb-overlay">
                                                <a class="video-icon" href="{{ route('watch',@$slider->item->id) }}"><i class="fas fa-play"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="movie-section ptb-80 section"  data-section="single1">
        <div class="container">
            <div class="row justify-content-center align-items-center mb-30-none">
                <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 mb-30">
                    <div class="movie-section-header-wrapper">
                        <div class="movie-section-header">
                            <h2 class="title">@lang('Featured Movies to Watch Now')</h2>
                            <p>@lang('Most watched movies by days')</p>
                        </div>
                        <div class="movie-slider-arrow">
                            <div class="slider-prev">
                                <i class="fas fa-angle-left"></i>
                            </div>
                            <div class="slider-next">
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 mb-30">
                    <div class="movie-slider">
                        <div class="swiper-wrapper">
                            @foreach($featuredMovies as $featured)
                                <div class="swiper-slide">
                                    <div class="movie-item">
                                        <div class="movie-thumb">
                                            <img src="{{ getImage(getFilePath('item_portrait').$featured->image->portrait) }}" alt="movie">
                                            @if($featured->item_type == 1 && $featured->version == 0)
                                                <span class="movie-badge">@lang('Free')</span>
                                            @elseif($featured->item_type == 3)
                                                <span class="movie-badge">@lang('Trailer')</span>
                                            @endif
                                            <div class="movie-thumb-overlay">
                                                <a class="video-icon" href="{{ route('watch',$featured->id) }}"><i class="fas fa-play"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="sections">

    </div>
    <div class="custom_loading"></div>
@endsection

@push('script')
    <script>
        "use strict";
        var send = 0;
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 60) {
                if ($('.section').hasClass('last-item')) {
                    $('.custom_loading').removeClass('loader-area');
                    return false;
                }

                $('.custom_loading').addClass('loader-area');
                setTimeout(function () {
                    if (send == 0) {
                        send = 1;
                        var sec = $('.section').last().data('section');
                        var url = '{{ route('getSection') }}';
                        var data = {sectionName: sec};
                        $.get(url, data, function (response) {
                            if (response == 'end') {
                                $('.section').last().addClass('last-item');
                                $('.custom_loading').removeClass('loader-area');
                                $('.footer').removeClass('d-none');
                                return false;
                            }
                            $('.custom_loading').removeClass('loader-area');
                            $('.sections').append(response);
                            send = 0;
                        });

                    }
                }, 1000)
            }
        });
    </script>
@endpush
