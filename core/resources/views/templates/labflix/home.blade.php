@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
$banner_content = getContent('banner.content', true);
@endphp
<section class="hero">
  <div class="hero__slider">
    @foreach($sliders as $slider)
    @if($slider->caption_show != 1)
    <div class="single-slide">
      <a href="{{ route('watch',$slider->item->id) }}">
        <img src="{{ getImage(getFilePath('slider').'/'.$slider->image) }}" alt="hero-image">
      </a>
    </div>
    @else
    <div class="movie-slide bg_img" data-background="{{ getImage(getFilePath('slider').'/'.$slider->image) }}">
      <div class="movie-slide__content">
        <h2 class="movie-name" data-animation="fadeInUp" data-delay=".2s">{{ __($slider->item->title) }}</h2>
        <ul class="movie-meta justify-content-lg-start justify-content-center" data-animation="fadeInUp" data-delay=".4s">
          <li><i class="fas fa-star color--glod"></i> <span>({{ __($slider->item->ratings) }})</span></li>
          <li><span>{{ __($slider->item->category->name) }}</span></li>
        </ul>
        <p data-animation="fadeInUp" data-delay=".7s">{{ __($slider->item->preview_text) }}</p>
        <div class="btn-area justify-content-lg-start justify-content-center align-items-center mt-lg-5 mt-sm-3 mt-2" data-animation="fadeInLeft" data-delay="1s">
          @if($slider->item->item_type == 3)
          <a href="{{ route('watch',$slider->item->id) }}" class="video-btn justify-content-lg-start justify-content-center">
            <div class="icon">
              <i class="fas fa-play"></i>
            </div>
            <span>@lang('Watch Trailer')</span>
          </a>
          @else
          <a href="{{ route('watch',$slider->item->id) }}" class="video-btn justify-content-lg-start justify-content-center">
            <div class="icon">
              <i class="fas fa-play"></i>
            </div>
            <span>@lang('Watch Now')</span>
          </a>
          @endif
        </div>
      </div>
    </div>
    @endif
    @endforeach
  </div>
</section>

<section class="pt-80 pb-80 section" data-section="single1">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-header">
          <h2 class="section-title">@lang('Featured Items')</h2>
        </div>
      </div>
    </div><!-- row end -->
    <div class="movie-slider-one">
      @foreach($featuredMovies as $featured)
      <div class="movie-card @if($featured->item_type == 1 && $featured->version == 1 || $featured->item_type == 2) paid @endif " @if($featured->item_type == 1 && $featured->version == 0) data-text="@lang('Free')" @elseif($featured->item_type == 3) data-text="@lang('Trailer')" @endif>
        <div class="movie-card__thumb">

          <img src="{{ getImage(getFilePath('item_portrait').'/'.@$featured->image->portrait) }}" alt="image">
          <a href="{{ route('watch',$featured->id) }}" class="icon"><i class="fas fa-play"></i></a>
        </div>
        <div class="movie-card__content">
          <h6><a href="{{ route('watch',$featured->id) }}">{{ __(short_string($featured->title,17)) }}</a></h6>
          <ul class="movie-card__meta">
            <li><i class="far fa-eye color--primary"></i> <span>{{ __(numFormat($featured->view)) }}</span></li>
            <li><i class="fas fa-star color--glod"></i> <span>({{ __($featured->ratings) }})</span></li>
          </ul>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<div class="sections">

</div>
@endsection

@push('script')
<script type="text/javascript">
  "use strict";
  var send = 0;

  $(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() > $(document).height() - 60) {
      if ($('.section').hasClass('last-item')) {
        $('.loading').removeClass('loader');
        return false;
      }
      $('.loading').addClass('loader');
      setTimeout(function(){
        if (send == 0) {
            send = 1;
            var sec = $('.section').last().data('section');
            var url = '{{ route('getSection') }}';
            var data = {sectionName:sec};
            $.get(url, data, function(response){
              if (response == 'end') {
                $('.section').last().addClass('last-item');
                $('.loading').removeClass('loader');
                $('.footer').removeClass('d-none');
                return false;
              }
              $('.loading').removeClass('loader');
              $('.sections').append(response);
              send = 0;
            });
          }
      }, 1000)
    }
  });
</script>
@endpush
