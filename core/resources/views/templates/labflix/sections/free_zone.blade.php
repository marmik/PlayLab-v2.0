<section class="pb-80 section" data-section="end">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-header">
              <h2 class="section-title">@lang('Free Zone')</h2>
            </div>
          </div>
        </div><!-- row end -->
        <div class="row mb-none-30">
          @foreach($frees as $free)
          <div class="col-xxl-2 col-md-3 col-4 col-xs-6 mb-30">
            <div class="movie-card paid">
              <div class="movie-card__thumb thumb__2">
                <img src="{{ getImage(getFilePath('item_portrait').'/'.$free->image->portrait) }}" alt="image">
                <a href="{{ route('watch',$free->id) }}" class="icon"><i class="fas fa-play"></i></a>
              </div>
            </div><!-- movie-card end -->
          </div>
          @endforeach
        </div>
      </div>
    </section>
