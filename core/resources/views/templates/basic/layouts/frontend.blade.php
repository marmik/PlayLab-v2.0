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
    <link href="{{ asset('assets/global/css/all.min.css') }}" rel="stylesheet">
    <link href="{{asset('assets/global/css/global.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/global/css/line-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/video-js.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/animate.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/style.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/color.php?color='.$general->base_color)}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/bootstrap-fileinput.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/custom.css')}}">
    @stack('style-lib')
    @stack('style')

    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'css/color.php') }}?color={{ $general->base_color }}&secondColor={{ $general->secondary_color }}">
</head>
<body>

@stack('fbComment')
@include($activeTemplate.'partials.preloader')
@include($activeTemplate.'partials.frontend_header')
    
@if (!request()->routeIs('home'))
    @include($activeTemplate.'partials.breadcrumb')
@endif

<a href="#" class="scrollToTop"><i class="las la-angle-double-up"></i></a>

@yield('content')

@include($activeTemplate.'partials.footer')

@php
    $cookie = App\Models\Frontend::where('data_keys','cookie.data')->first();
@endphp
@if(($cookie->data_values->status == 1) && !\Cookie::get('gdpr_cookie'))
<!-- cookies dark version start -->
<div class="cookies-card text-center hide">
    <div class="cookies-card__icon bg--base">
        <i class="las la-cookie-bite"></i>
    </div>
    <p class="mt-4 cookies-card__content">{{ $cookie->data_values->short_desc }} <a href="{{ route('cookie.policy') }}" target="_blank" class="text--base">@lang('learn more')</a></p>
    <div class="cookies-card__btn mt-4">
        <a href="javascript:void(0)" class="btn btn--base w-100 policy">@lang('Allow')</a>
    </div>
</div>

<!-- cookies dark version end -->
@endif

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('assets/global/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/global/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/global/js/global.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/swiper.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/videojs-ie8.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/video.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/wow.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/main.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'js/custom.js')}}"></script>

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

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
            matched = event.matches;
            if(matched){
                $('body').addClass('dark-mode');
                $('.navbar').addClass('navbar-dark');
            }else{
                $('body').removeClass('dark-mode');
                $('.navbar').removeClass('navbar-dark');
            }
        });

        let matched = window.matchMedia('(prefers-color-scheme: dark)').matches;
        if(matched){
            $('body').addClass('dark-mode');
            $('.navbar').addClass('navbar-dark');
        }else{
            $('body').removeClass('dark-mode');
            $('.navbar').removeClass('navbar-dark');
        }

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

    })(jQuery);
</script>

</body>
</html>
