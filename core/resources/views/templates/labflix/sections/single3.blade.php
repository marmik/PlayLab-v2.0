<section class="pb-80 bg_img dark--overlay section" style="background-image: url({{ getImage('assets/images/item/landscape/'.@$single[2]->image->landscape) }});" data-section="free_zone">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-xl-5 col-lg-6">
            <div class="single-movie-thumb">

              <img src="{{ getImage(getFilePath('item_landscape').'/'.@$single[2]->image->landscape) }}" alt="image">
              @if(@$single[2])
              <a href="{{ route('watch',@$single[2]->id) }}" class="video-btn">
                <div class="icon">
                  <i class="fas fa-play"></i>
                </div>
              </a>
              @endif
            </div>
          </div>
          <div class="col-xl-5 col-lg-6 pl-lg-4 mt-lg-0 mt-4">
            <div class="single-movie-content">
              <h2><a href="{{ getImage(getFilePath('item_landscape').'/'.@$single[2]->image->landscape) }}">{{ __(@$single[2]->title) }}</a></h2>
              <ul class="movie-card__meta justify-content-start mt-2 mb-4">
                <li><i class="far fa-eye color--primary"></i> <span>{{ __(numFormat(@$single[2]->view)) }}</span></li>
                <li><i class="fas fa-star color--glod"></i> <span>({{ __(@$single[2]->ratings) }})</span></li>
              </ul>
              <p>{{ __(@$single[2]->preview_text) }}</p>
              @if(@$single[2])
              <a href="{{ route('watch',@$single[2]->id) }}" class="cmn-btn mt-4">
                @if(@$single[2]->item_type == 3)
                  @lang('Watch Trailer')
                @else
                  @lang('Watch Now')
                @endif
              </a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="ad-section pt-80">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            @php echo showAd(); @endphp
          </div>
        </div>
      </div>
    </div>
