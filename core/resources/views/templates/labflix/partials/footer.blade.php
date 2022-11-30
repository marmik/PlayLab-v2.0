<!-- footer section start -->
@php
$policies = getContent('policy_pages.element');
$footer = getContent('footer.content',true);
$links = getContent('short_links.element',false,null,true);
$subscriber = getContent('subscribe.content',true);
$socials = getContent('social_icon.element');
@endphp
<footer class="footer 
  @if(request()->routeIs('home') || request()->routeIs('category') || request()->routeIs('subCategory') || request()->routeIs('search'))
 d-none
@endif
 ">
    <div class="footer__top">
        <div class="container">
            <div class="row mb-none-30">
                <div class="col-lg-4 col-sm-8 mb-50">
                    <div class="footer-widget">
                        <a href="{{ route('home') }}"><img src="{{getImage(getFilePath('logoIcon') .'/logo.png')}}" alt="image" class="mb-4"></a>
                        <p>{{ __(@$footer->data_values->about_us) }}</p>
                        <ul class="social-links mt-3">
                            @foreach($socials as $social)
                            <li><a href="{{ @$social->data_values->url }}">@php echo @$social->data_values->social_icon @endphp</a></li>
                            @endforeach
                        </ul>
                    </div><!-- footer-widget end -->
                </div>
                <div class="col-lg-2 col-sm-4 mb-50">
                    <div class="footer-widget">
                        <h4 class="footer-widget__title">@lang('Short Links')</h4>
                        <ul class="link-list">
                            @foreach($links as $link)
                            <li><a href="{{ route('links',[$link->id,slug($link->data_values->title)]) }}">{{ __($link->data_values->title) }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- footer-widget end -->
                </div>
                <div class="col-lg-2 col-sm-4 mb-50">
                    <div class="footer-widget">
                        <h4 class="footer-widget__title">@lang('Category')</h4>
                        <ul class="link-list">
                            @foreach($categories as $category)
                            <li><a href="{{ route('category',$category->id) }}">{{ __($category->name) }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- footer-widget end -->
                </div>
                <div class="col-lg-4 col-sm-8 mb-50">
                    <div class="footer-widget">
                        <h4 class="footer-widget__title">{{ __(@$footer->data_values->subscribe_title) }}</h4>
                        <p>{{ __(@$footer->data_values->subscribe_subtitle) }}</p>
                        <form class="subscribe-form mt-3">
                            @csrf
                            <input type="email" name="email" placeholder="@lang('Email Address')">
                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div><!-- footer-widget end -->
                </div>
            </div>
        </div>
    </div><!-- footer__top end -->
    <div class="footer__bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-md-left text-center">
                    <p>@lang('All rights &amp; Copy right reserved by') <a href="{{ route('home') }}">{{ __($general->sitename) }}</a></p>
                </div>
                <div class="col-md-6 mt-md-0 mt-3">
                    <ul class="links justify-content-md-end justify-content-around">
                        @foreach($policies as $policy)
                        <li><a href="{{ route('policies',[$policy->id,slug($policy->data_values->title)]) }}">{{ __($policy->data_values->title) }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>