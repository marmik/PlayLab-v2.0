<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ $general->siteName(__($pageTitle)) }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('partials.seo')

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/fontawesome-all.min.css')}}">
    <link href="{{ asset('assets/global/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{asset('assets/global/css/all.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/video-js.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/global/css/line-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/animate.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/style.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/bootstrap-fileinput.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/custom.css')}}">
    
    @stack('style-lib')
    @stack('style')

    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'css/color.php') }}?color={{ $general->base_color }}&secondColor={{ $general->secondary_color }}">
</head>

<body>

    @include($activeTemplate.'partials.preloader')
    @include($activeTemplate.'partials.master_header')
    <a href="#" class="scrollToTop"><i class="las la-angle-double-up"></i></a>

    @include($activeTemplate.'partials.breadcrumb')
    @yield('content')

    @include($activeTemplate.'partials.footer')

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('assets/global/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/global/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/global/js/global.js')}}"></script>
    
    <script src="{{asset($activeTemplateTrue.'js/swiper.min.js')}}"></script>
    <!-- video js-->
    <script src="{{asset($activeTemplateTrue.'js/videojs-ie8.min.js')}}"></script>
    <!-- video js-->
    <script src="{{asset($activeTemplateTrue.'js/video.js')}}"></script>
    <script src="{{ asset($activeTemplateTrue.'js/jquery.syotimer.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue.'js/syotimer.lang.js') }}"></script>
    <!-- wow js file -->
    <script src="{{asset($activeTemplateTrue.'js/wow.min.js')}}"></script>
    <!-- main -->
    <script src="{{asset($activeTemplateTrue.'js/main.js')}}"></script>

    <script src="{{asset($activeTemplateTrue.'js/bootstrap-fileinput.js')}}"></script>

    <script src="{{ asset($activeTemplateTrue.'js/jquery.validate.js') }}"></script>

    @stack('script-lib')

    @include('partials.notify')
    
    @include('partials.plugins')

    @stack('script')


    <script>
        (function ($) {
            "use strict";

            $('.showFilterBtn').on('click',function(){
                $('.responsive-filter-card').slideToggle();
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
                        iziToast.success({message: response.success, position: "topRight"});
                    }
                });
            });

        })(jQuery);

    </script>

