@extends($activeTemplate.'layouts.master')
@section('content')
@if($user->exp > now())
<div class="card-area pt-80 pb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card custom--card">
                    <div class="card-header text-center">
                        <h4 class="card-title mb-0">
                            @lang('Current subscription plan is '.@auth()->user()->plan->name)
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="card-body-content text-center">
                            <h3 class="title">@lang('Subscription will be expired')</h3>
                        </div>
                        <div class="draw-countdown mt-3"
                            data-year="{{ \Carbon\Carbon::parse(auth()->user()->exp)->format('Y') }}"
                            data-month="{{ \Carbon\Carbon::parse(auth()->user()->exp)->format('m') }}"
                            data-day="{{ \Carbon\Carbon::parse(auth()->user()->exp)->format('d') }}"
                            data-hour="{{ \Carbon\Carbon::parse(auth()->user()->exp)->format('H') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
@if(auth()->user()->deposits->where('status',2)->count() > 0)
<div class="card-area section--bg pt-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card custom--card">
                    <div class="card-body">
                        <div class="card-body-content text-center">
                            <h3 class="title">@lang('Your payment is now in pending, please wait for admin response')</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<section class="pt-80 pb-80">
    <div class="container">
        <div class="row justify-content-center mb-30-none">

            @forelse($plans as $plan)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                <div class="package-card text-center">
                    <div class="package-card__icon">
                        @php echo $plan->icon @endphp
                    </div>
                    <h6 class="package-card__name">{{ __($plan->name) }}</h6>
                    <div class="package-card__price">{{ $general->cur_sym }}{{ getAmount($plan->pricing) }}</div>
                    <p class="mb-3">@lang('Get '.$plan->duration.' days subscribtion')</p>
                    @if(auth()->user()->deposits->where('status',2)->count() > 0)
                    <button class="cmn-btn" disabled>@lang('Subscribe Now')</button>
                    @else
                    <button class="cmn-btn buyBtn" data-id="{{ $plan->id }}">@lang('Subscribe Now')</button>
                    @endif
                </div>
            </div>
            @empty
            @endforelse

        </div>
    </div>
</section>
@endif

<div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Subscribe Plan')</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.subscribePlan') }}" method="post">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <h4 class="base--color">@lang('Are you sure to subscribe this plan?')</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="cmn-btn btn-sm">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    "use strict";
        $('.buyBtn').click(function () {
            var modal = $('#buyModal');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.modal('show');
        });
</script>
@endpush