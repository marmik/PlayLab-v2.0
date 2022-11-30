@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
$policyPages = getContent('policy_pages.element',false,null,true);
$register = getContent('register.content', true);
@endphp

<section class="pt-80 pb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="account-area">
                    <form class="account-from w-100" action="{{ route('user.register') }}" method="post" onsubmit="return submitUserForm();">
                        @csrf
                        <div class="form-group">
                            <label>@lang('Username')</label>
                            <input type="text" class="form-control checkUser" name="username" placeholder="@lang('Username')" value="{{ old('username') }}" required>
                            <small class="text-danger usernameExist"></small>
                        </div>
                        <div class="form-group">
                            <label>@lang('Email')</label>
                            <input type="email" class="form-control checkUser" name="email" placeholder="@lang('Email')" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <label>@lang('Country')*</label>
                           <div class="input-group">
                                <select name="country" id="country" class="form-control form-select">
                                    @foreach($countries as $key => $country)
                                    <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}" data-code="{{ $key }}" class="text-white">{{ __($country->country) }}</option>
                                    @endforeach
                                </select>
                           </div>
                        </div>

                        <div class="form-group">
                            <label>@lang('Mobile')*</label>
                            <div class="input-group">
                                <span class="input-group-text mobile-code"></span>
                                <input type="hidden" name="mobile_code">
                                <input type="hidden" name="country_code">
                                <input type="number" name="mobile" id="mobile" value="{{ old('mobile') }}" class="form-control checkUser">
                            </div>
                            <small class="text-danger mobileExist"></small>
                        </div>

                        <div class="form-group">
                            <label>@lang('Password')*</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                            @if($general->secure_password)
                            <div class="input-popup">
                                <p class="error lower">@lang('1 small letter minimum')</p>
                                <p class="error capital">@lang('1 capital letter minimum')</p>
                                <p class="error number">@lang('1 number minimum')</p>
                                <p class="error special">@lang('1 special character minimum')</p>
                                <p class="error minimum">@lang('6 character password')</p>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>@lang('Re-Password')</label>
                            <input type="password" name="password_confirmation" placeholder="@lang('Re-Password')" class="form-control">
                        </div>
                        <div class="col-lg-12 form-group">
                            @php echo loadReCaptcha() @endphp
                        </div>
                        <x-captcha></x-captcha>
                        @if($general->agree)
                              <div class="col-lg-12 form-group">
                                  <div class="checkbox-wrapper d-flex flex-wrap align-items-center">
                                      <div class="custom--checkbox">
                                        <input type="checkbox" id="agree" name="agree" class="checkbox--input">
                                        <label for="agree" class="checkbox--label">
                                            @lang('I agree with')
                                            @forelse($policyPages as $item)
                                                <a href="{{ route('policies',[$item->id,slug($item->data_values->title)]) }}" target="_blank" class="base--color">{{ __($item->data_values->title) }}</a>
                                                {{ $loop->last ? '' : ',' }}
                                            @empty
                                            @endforelse
                                        </label>
                                    </div>

                                  </div>
                              </div>
                          @endif
                        
                        <div class="text-center">
                            <button type="submit" class="cmn-btn w-100">@lang('Register')</button>
                        </div>
                        <p class="mt-3">@lang("Already have an account?") <a href="{{ route('user.login') }}" class="base--color">@lang('Login now')</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



<div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </span>
            </div>
            <div class="modal-body">
                <h6 class="text-center">@lang('You already have an account please Login ')</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
                <a href="{{ route('user.login') }}" class="cmn-btn btn-sm">@lang('Login')</a>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style')
<style>
    .country-code .input-group-text {
        background: #fff !important;
    }

    .country-code select {
        border: none;
    }

    .country-code select:focus {
        border: none;
        outline: none;
    }
</style>
@endpush
@push('script-lib')
<script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush
@push('script')
    <script>
      "use strict";
        (function ($) {
            @if($mobile_code)
            $(`option[data-code={{ $mobile_code }}]`).attr('selected','');
            @endif

            $('select[name=country]').change(function(){
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+'+$('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+'+$('select[name=country] :selected').data('mobile_code'));
            @if($general->secure_password)
                $('input[name=password]').on('input',function(){
                    secure_password($(this));
                });

                $('[name=password]').focus(function () {
                    $(this).closest('.form-group').addClass('hover-input-popup');
                });

                $('[name=password]').focusout(function () {
                    $(this).closest('.form-group').removeClass('hover-input-popup');
                });


            @endif

            $('.checkUser').on('focusout',function(e){
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {mobile:mobile,_token:token}
                }
                if ($(this).attr('name') == 'email') {
                    var data = {email:value,_token:token}
                }
                if ($(this).attr('name') == 'username') {
                    var data = {username:value,_token:token}
                }
                $.post(url,data,function(response) {
                  if (response.data != false && response.type == 'email') {
                    $('#existModalCenter').modal('show');
                  }else if(response.data != false){
                    $(`.${response.type}Exist`).text(`${response.type} already exist`);
                  }else{
                    $(`.${response.type}Exist`).text('');
                  }
                });
            });
        })(jQuery);

    </script>
@endpush