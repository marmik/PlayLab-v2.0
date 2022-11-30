<header class="header-section">
    <div class="header">
        <div class="header-bottom-area">
            <div class="container">
                <div class="header-menu-content">
                    <nav class="navbar navbar-expand-lg p-0">
                        <a class="site-logo site-title" href="{{route('home')}}"><img src="{{ asset('assets/images/logoIcon/logo.png') }}" alt="site-logo"></a>
                        <div class="search-bar d-block d-lg-none ml-auto">
                            <a href="#0"><i class="fas fa-search"></i></a>
                            <div class="header-top-search-area">
                                <form class="header-search-form" action="{{ route('search') }}">
                                    <input type="search" name="search" placeholder="@lang('Search here')...">
                                    <button class="header-search-btn" type="submit"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <button class="navbar-toggler ml-auto" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="fas fa-bars"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav main-menu ms-auto me-auto">
                                <li><a href="{{ route('user.home') }}">@lang('Dashboard')</a></li>
                                <li><a href="{{ route('user.deposit.history') }}">@lang('Payments')</a></li>
                                <li><a href="{{ route('user.wishlist') }}">@lang('My Wishlists')</a></li>
                                <li><a href="{{ route('user.watch.history') }}">@lang('Watch History')</a></li>
                                <li><a href="javascript:void(0)">@lang('Ticket') <i class="fas fa-caret-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('ticket.open')}}">@lang('Create New')</a></li>
                                        <li><a href="{{route('ticket')}}">@lang('My Ticket')</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="search-bar d-none d-lg-block">
                                <a href="javascript:void(0)"><i class="fas fa-search"></i></a>
                                <div class="header-top-search-area">
                                    <form class="header-search-form" action="{{ route('search') }}">
                                        <input type="search" name="search" placeholder="@lang('Search here')...">
                                        <button class="header-search-btn" type="submit"><i class="fas fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="header-bottom-right">
                                <div class="language-select-area">
                                    <select class="language-select langSel" id="langSel">
                                        @foreach($language as $lang)
                                            <option value="{{$lang->code}}" @if(Session::get('lang') === $lang->code) selected  @endif>{{ __($lang->code) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="header-right dropdown">
                                <button type="button" class="" data-bs-toggle="dropdown" data-display="static" aria-haspopup="true"
                                        aria-expanded="false">
                                    <div class="header-user-area d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="header-user-content">
                                            <span>@lang('Account')</span>
                                        </div>
                                        <span class="header-user-icon"><i class="las la-chevron-circle-down"></i></span>
                                    </div>
                                </button>
                                <div class="dropdown-menu dropdown-menu--sm p-0 border-0 dropdown-menu-end">
                                    <a href="{{ route('user.profile.setting') }}" class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                                        <i class="dropdown-menu__icon las la-user-circle"></i>
                                        <span class="dropdown-menu__caption">@lang('Profile Settings')</span>
                                    </a>
                                    <a href="{{ route('user.change.password') }}" class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                                        <i class="dropdown-menu__icon las la-key"></i>
                                        <span class="dropdown-menu__caption">@lang('Change Password')</span>
                                    </a>
                                    <a href="{{ route('user.logout') }}" class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                                        <i class="dropdown-menu__icon las la-sign-out-alt"></i>
                                        <span class="dropdown-menu__caption">@lang('Logout')</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>