@extends($activeTemplate.'layouts.master')
@section('content')
<div class="card-area pt-80 pb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="">
                    <div class="">
                        <ul class="wishlist-card-list">
                            @forelse($histories as $history)
                                @php
                                    $path = ($history->item_id == 0)  ? 'episode' : 'item_landscape';
                                    if($history->item_id == 0){
                                        $itemImage = getImage(getFilePath($path) . '/' . $history->episode->image);
                                        $description = @$history->episode->item->description;
                                    }else{
                                        $itemImage = getImage(getFilePath($path) . '/' . $history->item->image->landscape);
                                        $description = @$history->item->description;
                                    }
                                @endphp
                                <li class="wishlist-card-list__item">
                                    <div class="wishlist-card-wrapper">
                                        <a href="{{ route('watch', $history->item_id) }}" class="wishlist-card-list__link">
                                            <div class="wishlist-card">
                                                <div class="wishlist-card__thumb">
                                                    <img src="{{ $itemImage }}" alt="">
                                                </div>
                                                <div class="wishlist-card__content">
                                                    <h5 class="wishlist-card__title">
                                                        @if ($history->item_id)
                                                        {{ __($history->item->title) }}
                                                        @else
                                                        {{ __($history->episode->item->title) }} - {{ __($history->episode->title) }}
                                                        @endif
                                                    </h5>
                                                    <p class="wishlist-card__desc text-white">{{ strLimit($description,60) }}</p>
                                                </div>
                                            </div>
                                        </a>
                                         <div class="wishlist-card-wrapper__icon">
                                            <button type="button" class="base--color confirmationBtn"  data-action="{{ route('user.remove.history',$history->id) }}" data-question="@lang('Are you sure to remove this item?')" data-submit_text="cmn-btn"><i class="las la-times"></i></button>
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

