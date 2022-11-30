@php
    $footer_content = getContent('footer.content', true);
    $socialIcons = getContent('social_icon.element', false, null, true);
    $policyPages = getContent('policy_pages.element');
    $short_links = getContent('short_links.element');
@endphp
<footer class="footer-section footer pt-80 bg-overlay-black bg_img @if(request()->routeIs('home') || request()->routeIs('category') || request()->routeIs('subCategory') || request()->routeIs('search')) d-none @endif" data-background="{{ getImage('assets/images/frontend/footer/' . @$footer_content->data_values->background_image, '1920x789') }}">
    <div class="container">
        <div class="footer-top-area d-flex flex-wrap align-items-center justify-content-between">
            <div class="footer-logo">
                <a href="{{ route('home') }}" class="site-logo"><img src="{{ asset('assets/images/logoIcon/logo.png') }}" alt="logo"></a>
            </div>
            <div class="social-area">
                <ul class="footer-social">
                    @foreach($socialIcons as $item)
                        <li><a href="{{ @$item->data_values->url }}" target="_blank">@php echo @$item->data_values->social_icon @endphp</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="footer-bottom-area">
            <div class="row justify-content-center mb-30-none">
                <div class="col-xl-4 col-lg-3 col-md-6 col-sm-6 mb-30">
                    <div class="footer-widget">
                        <h3 class="widget-title">@lang('About Us')</h3>
                        <p>{{ __(@$footer_content->data_values->about_us) }}</p>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 mb-30">
                    <div class="footer-widget">
                        <h3 class="widget-title">@lang('Categories')</h3>
                        <ul class="footer-links">
                            @foreach($categories as $category)
                                <li><a href="{{ route('category',$category->id) }}">{{ __($category->name) }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 mb-30">
                    <div class="footer-widget">
                        <h3 class="widget-title">@lang('Short Links')</h3>
                        <ul class="footer-links">

                            @forelse($short_links as $link)
                                <li><a href="{{ route('links',[$link->id,slug($link->data_values->title)]) }}">{{ __($link->data_values->title) }}</a></li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-3 col-md-6 col-sm-6 mb-30">
                    <div class="footer-widget">
                        <h3 class="widget-title">@lang('Subscribe News Letter')</h3>
                        <p>{{ __(@$footer_content->data_values->subscribe_title) }}</p>
                        <form class="subscribe-form" method="post">
                            @csrf
                            <input type="email" name="email" placeholder="@lang('Email Address')" required>
                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12 text-center">
                    <div class="copyright-wrapper d-flex flex-wrap align-items-center justify-content-between">
                        <div class="copyright">
                            <p>@lang('Copyright') &copy; <a href="{{ route('home') }}" class="text--base">{{ $general->sitename }}</a> {{ date('Y') }} @lang('All Rights Reserved')
                            </p>
                        </div>
                        <div class="copyright-link-area">
                            <ul class="copyright-link">
                                @foreach($policyPages as $item)
                                    <li><a href="{{ route('policies',[$item->id,slug($item->data_values->title)]) }}">{{ __($item->data_values->title) }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>