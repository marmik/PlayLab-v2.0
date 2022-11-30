@extends($activeTemplate.'layouts.frontend')

@section('content')
@php
$login = getContent('login.content',true);
@endphp

<section class="pt-80 pb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="account-area">
                    <div class="left text-center">
                        <img src="{{getImage(getFilePath('logoIcon') .'/logo.png')}}" alt="logo">
                    </div>
                    <div class="right">
                        <form class="account-from" action="{{ route('user.login') }}" method="post" onsubmit="return submitUserForm();">
                            @csrf
                            <div class="form-group">
                                <label>@lang('Username')</label>
                                <input type="text" name="username" placeholder="@lang('Username')" class="form-control" value="{{ old('username') }}">
                            </div>
                            <div class="form-group">
                                <label>@lang('Password')</label>
                                <input type="password" name="password" placeholder="@lang('Password')" class="form-control">
                            </div>
                            <div class="col-lg-12 form-group">
                                @php echo loadReCaptcha() @endphp
                            </div>
                            <x-captcha></x-captcha>
                            <div class="text-center">
                                <button type="submit" class="cmn-btn w-100">@lang('Login')</button>
                            </div>
                            <p class="mt-3">@lang("Forgate password?") <a href="{{ route('user.password.request') }}" class="base--color">@lang('Reset now')</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('script')
<script>
    "use strict";
        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span class="text-danger">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }
</script>
@endpush