
    <section class="pb-80 section" data-section="single3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-header">
              <h2 class="section-title">@lang('Latest Trailer')</h2>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach($latest_trailers as $trailer)
          <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6 mb-4">
            <div class="trailer-card">
              <div class="trailer-card__thumb">

                <img src="{{ getImage(getFilePath('item_landscape').'/'.$trailer->image->landscape) }}" alt="image">
                <div class="trailer-card__content">
                  <h4><a href="{{ route('watch',$trailer->id) }}">{{ __($trailer->title) }}</a></h4>
                </div>
              </div>
            </div>
          </div>
          @endforeach
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
