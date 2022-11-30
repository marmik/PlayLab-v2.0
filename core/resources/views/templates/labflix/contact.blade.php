@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="pt-80 pb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card custom--card">
                    <div class="card-header">
                        <h2 class="contact-form__title">{{ __($pageTitle) }}</h2>
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
                                <button type="submit" class="cmn-btn w-100">@lang('Submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="contact-map">
                    <iframe class="contact-map__iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29624007.58460168!2d115.22979863156776!3d-24.992915938390176!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2b2bfd076787c5df%3A0x538267a1955b1352!2sAustralia!5e0!3m2!1sen!2sbd!4v1656857476955!5m2!1sen!2sbd" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
