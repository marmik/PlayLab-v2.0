@extends($activeTemplate.'layouts.master')
@section('content')
<div class="card-area pt-80 pb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="">
                    <div class="">
                        <ul class="wishlist-card-list">
                            @forelse($wishlists as $wishlist)
                                @php
                                $path = ($wishlist->episode_id != 0) ? 'episode' : 'item_landscape';
                                if($wishlist->episode_id != 0){
                                    $itemImage = getImage(getFilePath($path) . '/' . $wishlist->episode->image);
                                    $url = route('watch', [$wishlist->item_id, $wishlist->episode_id]);
                                }else{
                                    $itemImage = getImage(getFilePath($path) . '/' . $wishlist->item->image->landscape);
                                    $url = route('watch', $wishlist->item_id);
                                }
                                @endphp
                                <li class="wishlist-card-list__item">
                                    <div class="wishlist-card-wrapper">
                                        <a href="{{ $url }}" class="wishlist-card-list__link">
                                            <div class="wishlist-card">
                                                <div class="wishlist-card__thumb">
                                                    <img src="{{ $itemImage }}" alt="">
                                                </div>
                                                <div class="wishlist-card__content">
                                                    <h5 class="wishlist-card__title">
                                                        @if ($wishlist->item_id)
                                                        {{ __($wishlist->item->title) }}
                                                        @else
                                                        {{ __($wishlist->episode->item->title) }} - {{ __($wishlist->episode->title) }}
                                                        @endif
                                                    </h5>
                                                    <p class="wishlist-card__desc text-white">{{ strLimit(@$wishlist->item->description,60) }}</p>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="wishlist-card-wrapper__icon">
                                            <button type="button" class="text--base confirmationBtn"  data-action="{{ route('user.wishlist.remove',$wishlist->id) }}" data-question="@lang('Are you sure to remove this item?')" data-submit_text="cmn-btn btn-md"><i class="las la-times"></i></button>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <li class="text-center text--danger">{{ __($emptyMessage) }}</li>
                                @endforelse
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-confirmation-modal></x-confirmation-modal>
@endsection
@push('style')
    <style>
        .wishlist-image{
            height: 50px;
            width: 50px;
        }
        .wishlist-card__desc{
            font-size:14px;
        }
        .wishlist-card-wrapper__icon button{
                background: transparent;
                color: red;
                font-size: 20px;
        }
        .wishlist-card-list__item{
            border-bottom: 1px solid #353535;
        }
        .wishlist-card-list__item:last-child{
            border-bottom:none;
        }
    </style>
@endpush

