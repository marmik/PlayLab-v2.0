@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="movie-details-section section--bg ptb-80">
    <div class="container">
        <div class="row justify-content-center mb-30-none">
            <div class="col-xl-8 col-lg-8 mb-30">
                <div class="movie-item">
                    <div class="movie-video {{ !$watch ? 'subscribe-alert' : '' }}">
                        <video id="my-video" class="video-js" controls preload="auto" height="264"
                               poster="{{ getImage(getFilePath('item_landscape').'/'.$item->image->landscape) }}" data-setup="{}"
                               controlsList="nodownload">
                            @if($watch)
                                <source src="{{ $videoFile }}" type="video/mp4" />
                            @endif
                        </video>
                    </div>
                    <div class="movie-content">
                        <div class="movie-content-inner d-sm-flex flex-wrap justify-content-between align-items-center">
                            <div class="movie-content-left">
                                <h3 class="title">{{ __($item->title) }}</h3>
                                <span class="sub-title">@lang('Category') : <span class="cat">{{ @$item->category->name }}</span> @if($item->sub_category) @lang('Sub Category'): {{ @$item->sub_category->name }} @endif</span>
                            </div>
                            <div class="movie-content-right">
                                <div class="movie-widget-area align-items-center">
                                    <span class="movie-widget"><i class="lar la-star text--warning"></i> {{ getAmount($item->ratings) }}</span>
                                    <span class="movie-widget"><i class="lar la-eye text--danger"></i> {{ getAmount($item->view) }} @lang('views')</span>
                                   
                                    @php
                                        $wishlist = $item->wishlists->where('user_id', auth()->id())->count();
                                    @endphp
                        
                                    <span class="movie-widget addWishlist {{ $wishlist ? 'd-none' : '' }}"><i class="las la-plus-circle"></i></span>
                                    <span class="movie-widget removeWishlist {{ $wishlist ? '' : 'd-none' }}"><i class="las la-minus-circle"></i></span>
                                </div>

                                <ul class="post-share d-flex flex-wrap align-items-center justify-content-sm-end mt-2">
                                    <li class="caption">@lang('Share') : </li>
                
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('Facebook')">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"><i class="lab la-facebook-f"></i></a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('Linkedin')">
                                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{urlencode(url()->current()) }}&amp;title={{ __(@$item->title) }}&amp;summary=@php
                                            echo strLimit(strip_tags($item->description), 130);
                                        @endphp"><i class="lab la-linkedin-in"></i></a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('Twitter')">
                                        <a href="https://twitter.com/intent/tweet?text={{ __(@$item->title) }}%0A{{ url()->current() }}"><i class="lab la-twitter"></i></a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('Pinterest')">
                                        <a href="http://pinterest.com/pin/create/button/?url={{urlencode(url()->current()) }}&description={{ __(@$item->title) }}&media={{ getImage(getFilePath('item_landscape').'/'.@$item->image->landscape) }}"><i class="lab la-pinterest"></i></a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <div class="movie-widget-area">
                        </div>
                        <p class="movie-widget__desc">{{ __($item->preview_text) }}</p>
                    </div>
                </div>

                <div class="product-tab mt-40">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-tab-desc" data-bs-toggle="tab" href="#product-desc-content" role="tab"
                               aria-controls="product-desc-content" aria-selected="true">@lang('Description')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-tab-team" data-bs-toggle="tab" href="#product-team-content"
                               role="tab" aria-controls="product-team-content" aria-selected="false">@lang('Team')</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                             aria-labelledby="product-tab-desc">
                            <div class="product-desc-content">
                                {{ __($item->description) }}
                            </div>
                        </div>
                        <div class="tab-pane fade fade" id="product-team-content" role="tabpanel"
                             aria-labelledby="product-tab-team">
                            <div class="product-desc-content">
                                <ul class="team-list">
                                    <li><span>@lang('Director'):</span> {{ __($item->team->director) }}</li>
                                    <li><span>@lang('Producer'):</span> {{ __($item->team->producer) }}</li>
                                    <li><span>@lang('Cast'):</span> {{ __($item->team->casts) }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<section class="movie-section ptb-80">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section-header">
                    <h2 class="section-title">@lang('Related Items')</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-30-none">

            @foreach($relatedItems as $related)
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-6 mb-30">
                    <div class="movie-item">
                        <div class="movie-thumb">
                            <img src="{{ getImage(getFilePath('item_portrait').'/'.$related->image->portrait) }}" alt="movie">
                            @if($related->item_type == 1 && $related->version == 0)
                                <span class="movie-badge">@lang('Free')</span>
                            @elseif($related->item_type == 3)
                                <span class="movie-badge">@lang('Trailer')</span>
                            @endif
                            <div class="movie-thumb-overlay">
                                
                                <a class="video-icon" href="{{ route('watch', $related->id) }}"><i class="fas fa-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> @lang('Subscription Alert')!</h5>
                 <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <strong>@lang('Please subscribe a plan to view our paid items')</strong>
            </div>
            <div class="modal-footer">
                <a href="{{ route('user.home') }}" class="btn btn--default btn-sm w-100">@lang("Subscribe Now")</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
    @if(!$watch)
        <style>
            .video-js .vjs-big-play-button .vjs-icon-placeholder:before{
                content: "\f023";
            }
        </style>
    @endif
@endpush

@push('script')
<script>
    (function ($) {
        "use strict";

        $('.addWishlist').on('click', function(){
            let itemId = `{{ $item->id }}`;
            let url = `{{ route('wishlist.add') }}`;
            let csrf_token = `{{ csrf_token() }}`;

            $.ajax({
                type: "POST",
                url: url,
                data: { '_token': csrf_token, 'item_id': itemId },
                success: function (response) {
                    if(response.status == 'success'){
                        notify('success', response.message);
                        $('.addWishlist').addClass('d-none');
                        $('.removeWishlist').removeClass('d-none');
                    }else{
                        notify('error', response.message);
                    }
                }
            });
        });

        $('.removeWishlist').on('click', function(){
            let itemId = `{{ $item->id }}`;
            let url = `{{ route('wishlist.remove') }}`;
            let csrf_token = `{{ csrf_token() }}`;

            $.ajax({
                type: "POST",
                url: url,
                data: { '_token': csrf_token, 'item_id': itemId },
                success: function (response) {
                    console.log(response);
                    if(response.status == 'success'){
                        notify('success', response.message);
                        $('.addWishlist').removeClass('d-none');
                        $('.removeWishlist').addClass('d-none');
                    }else{
                        notify('error', response.message);
                    }
                }
            });
        });

        document.onkeydown = function(e) {
            if(e.keyCode == 123) {
            return false;
            }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
            return false;
            }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
            return false;
            }
            if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
            return false;
            }

            if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)){
            return false;
            }      
        }

        $('.subscribe-alert').on('click', function(){
            var modal = $('#alertModal');

            modal.modal('show');
        });

    })(jQuery);

</script>
@endpush