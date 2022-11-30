<section class="pb-80 section" data-section="latest_series">
      <div class="container-fluid">
        <div class="row gy-3">
          <div class="col-xxl-3 col-xl-4 col-lg-6 col-sm-6">
            <div class="section-header">
              <h2 class="section-title">@lang('Trending Videos')</h2>
            </div>
            <ul class="movie-small-list">
              @foreach($trendings as $trending)
              <li class="movie-small">
                <div class="movie-small__thumb">

                  <img src="{{ getImage(getFilePath('item_portrait').'/'.$trending->image->portrait) }}" alt="image">
                </div>
                <div class="movie-small__content">
                  <h5>{{ __($trending->title) }}</h5>
                  <ul class="movie-card__meta">
                    <li><i class="far fa-eye color--primary"></i> <span>{{ __(numFormat($trending->view)) }}</span></li>
                    <li><i class="fas fa-star color--glod"></i> <span>({{ __($trending->ratings) }})</span></li>
                  </ul>
                  <a href="{{ route('watch',$trending->id) }}" class="text-small base--color">
                    @if(@$trending->item_type == 3)
                      @lang('Watch Trailer')
                    @else
                      @lang('Watch Now')
                    @endif
                  </a>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="col-xxl-3 col-xl-4 col-lg-6 col-sm-6">
            <div class="section-header">
              <h2 class="section-title">@lang('Top Rated')</h2>
            </div>
            <ul class="movie-small-list">
              @foreach($topRateds as $topRated)
              <li class="movie-small">
                <div class="movie-small__thumb">

                  <img src="{{ getImage(getFilePath('item_portrait').'/'.$topRated->image->portrait) }}" alt="image">
                </div>
                <div class="movie-small__content">
                  <h5><a href="#0">{{ __($topRated->title) }}</a></h5>
                  <ul class="movie-card__meta">
                    <li><i class="far fa-eye color--primary"></i> <span>{{ __(numFormat($topRated->view)) }}</span></li>
                    <li><i class="fas fa-star color--glod"></i> <span>({{ __($topRated->ratings) }})</span></li>
                  </ul>
                  <a href="{{ route('watch',$topRated->id) }}" class="text-small base--color">
                    @if(@$topRated->item_type == 3)
                      @lang('Watch Trailer')
                    @else
                      @lang('Watch Now')
                    @endif
                  </a>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="col-xxl-6 col-xl-4">
            <div class="single-movie">
              <div class="single-movie__thumb">

                <img src="{{ getImage(getFilePath('item_landscape').'/'.@$mostViewsTrailer->image->landscape) }}" alt="image" class="w-100">
              </div>
              @if(@$mostViewsTrailer)
              <a href="{{ route('watch',@$mostViewsTrailer->id) }}" class="video-btn">
                <div class="icon">
                  <i class="fas fa-play"></i>
                </div>
                <span>@lang('Watch Trailer')</span>
              </a>
              @endif
            </div><!-- movie-card end -->
          </div>
        </div>
      </div>
    </section>
    <div class="ad-section pb-80">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            @php echo showAd(); @endphp
          </div>
        </div>
      </div>
    </div>
