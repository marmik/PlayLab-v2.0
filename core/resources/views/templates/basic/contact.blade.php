@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="section--bg ptb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-5">
                <div class="card custom--card">
                    <div class="card-header">
                        <h5>{{ __($pageTitle) }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="" class="verify-gcaptcha">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">@lang('Name')</label>
                                <input name="name" type="text" class="form-control form--control" value="@if(auth()->user()){{ auth()->user()->fullname }} @else{{ old('name') }}@endif" @if(auth()->user()) readonly @endif required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('Email')</label>
                                <input name="email" type="email" class="form-control form--control" value="@if(auth()->user()){{ auth()->user()->email }}@else{{  old('email') }}@endif" @if(auth()->user()) readonly @endif required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('Subject')</label>
                                <input name="subject" type="text" class="form-control form--control" value="{{old('subject')}}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('Message')</label>
                                <textarea name="message" wrap="off" class="form-control form--control" required>{{old('message')}}</textarea>
                            </div>
                            <x-captcha></x-captcha>
                            <div class="form-group">
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
