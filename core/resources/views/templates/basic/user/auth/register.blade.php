@extends($activeTemplate.'layouts.auth')
@section('content')
@php
    $policyPages = getContent('policy_pages.element',false,null,true);
    // $extra_pages = getContent('extra.element');
    $register = getContent('register.content', true);
@endphp
<section class="account-section bg-overlay-black bg_img" data-background="{{ getImage('assets/images/frontend/register/'.@$register->data_values->background_image, '1780x760') }}">
    <div class="container">
        <div class="row account-area align-items-center justify-content-center">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
                <div class="account-form-area">
                    <div class="account-logo-area text-center">
                        <div class="account-logo">
                            <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logoIcon/logo.png') }}"
                                                               alt="logo"></a>
                        </div>
                    </div>
                    <div class="account-header text-center">
                        <h3 class="title">@lang('Register form')</h3>
                    </div>
                    <form class="account-form" action="{{ route('user.register') }}" method="POST"
                    onsubmit="return submitUserForm();">
                  @csrf

                  <div class="row ml-b-20">
                        <div class="col-lg-6 form-group">
                            <label>{{ __('Username') }}*</label>
                            <input id="username" type="text" class="form-control form--control checkUser"
                                name="username" value="{{ old('username') }}" required>
                            <small class="text-danger usernameExist"></small>
                        </div>

                        <div class="col-lg-6 form-group">
                            <label>@lang('E-Mail Address')*</label>
                            <input id="email" type="email" class="form-control form--control checkUser"
                                name="email" value="{{ old('email') }}" required>
                        </div>
                      <div class="col-lg-6 form-group">
                          <label>@lang('Country')*</label>
                          <div class="input-group">
                              <select name="country" id="country" class="form-control form--control">
                                  @foreach($countries as $key => $country)
                                      <option data-mobile_code="{{ $country->dial_code }}"
                                              value="{{ $country->country }}" data-code="{{ $key }}"
                                              class="text-dark">{{ __($country->country) }}</option>
                                  @endforeach
                              </select>
                              <span class="input-group-text"><i class="las la-globe"></i></span>
                          </div>
                      </div>

                      <div class="col-lg-6 form-group">
                          <label>@lang('Mobile')*</label>
                          <div class="input-group">
                                <span class="input-group-text mobile-code bg--base"></span>
                                <input type="hidden" name="mobile_code">
                                <input type="hidden" name="country_code">
                              <input type="number" name="mobile" id="mobile" value="{{ old('mobile') }}"
                                     class="form-control form--control checkUser">
                          </div>
                          <small class="text-danger mobileExist"></small>
                      </div>

                     

                      <div class="col-lg-6 form-group">
                          <label>@lang('Password')*</label>
                          <input id="password" type="password" class="form-control form--control"
                                 name="password" required>
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
                      <div class="col-lg-6 form-group">
                          <label>@lang('Confirm Password')*</label>
                          <input id="password-confirm" type="password" class="form-control form--control"
                                 name="password_confirmation" required autocomplete="new-password">
                      </div>

                      <div class="col-lg-12 form-group">
                          @php echo loadReCaptcha() @endphp
                      </div>
                      <x-captcha></x-captcha>

                          @if($general->agree)
                              <div class="col-lg-12 form-group">
                                  <div class="checkbox-wrapper d-flex flex-wrap align-items-center">
                                      <div class="checkbox-item custom--checkbox">
                                          <input type="checkbox" id="agree" name="agree" class="checkbox--input">
                                          <label for="agree" class="checkbox--label">
                                              @lang('I agree with')
                                              @forelse($policyPages as $item)
                                                  <a href="{{ route('policies',[$item->id,slug($item->data_values->title)]) }}" target="_blank">{{ __($item->data_values->title) }}</a>
                                                  {{ $loop->last ? '' : ',' }}
                                              @empty
                                              @endforelse
                                          </label>
                                      </div>
                                  </div>
                              </div>
                          @endif

                      <div class="col-lg-12 form-group text-center">
                          <button type="submit" id="recaptcha" class="submit-btn">
                              @lang('Register')
                          </button>
                      </div>
                      <div class="col-lg-12 text-center">
                          <div class="account-item mt-10">
                              <label>@lang('Already Have An Account?') <a href="{{route('user.login')}}" class="text--base">@lang('Login Now')</a></label>
                          </div>
                      </div>
                  </div>
              </form>
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
        <a href="{{ route('user.login') }}" class="btn btn--base btn-sm">@lang('Login')</a>
      </div>
    </div>
  </div>
</div>
@endsection
@push('style')
<style>
    .country-code .input-group-text{
        background: #fff !important;
    }
    .country-code select{
        border: none;
    }
    .country-code select:focus{
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





