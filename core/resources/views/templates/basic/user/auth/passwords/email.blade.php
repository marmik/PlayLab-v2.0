@extends($activeTemplate.'layouts.auth')
@section('content')
@php
    $email = getContent('reset_password_email.content', true);
@endphp
<section class="account-section bg-overlay-black bg_img"
    data-background="{{ getImage('assets/images/frontend/reset_password_email/'.@$email->data_values->background_image, '1780x760') }}">
    <div class="container">
        <div class="row account-area align-items-center justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-5">
                <div class="card custom--card">
                    <div class="card-header">
                        <h5 class="title">{{ __($pageTitle) }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <p>@lang('To recover your account please provide your email or username to find your
                                account.')</p>
                        </div>
                        <form method="POST" action="{{ route('user.password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">@lang('Email or Username')</label>
                                <input type="text" class="form-control form--control" name="value"
                                    value="{{ old('value') }}" required autofocus="off">
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
