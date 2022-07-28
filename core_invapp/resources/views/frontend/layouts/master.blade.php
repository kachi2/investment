<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('desc')">
    <meta name="keywords" content="@yield('keyword')">
    <title>@yield('title') | {{ site_info('name') }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/apps.css?ver=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/front.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/slider/carouselTicker.css') }}">
@if(sys_settings('ui_theme_skin', 'default')!='default')
    <link rel="stylesheet" href="{{ asset('/assets/css/skins/theme-'.sys_settings('ui_theme_skin').'.css?ver=1.0.0') }}">
@endif
@if(sys_settings('google_track_id'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ sys_settings('google_track_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', "{{ sys_settings('google_track_id') }}");
    </script>
@endif
@if(sys_settings('header_code'))
    {{ html_string(sys_settings('header_code')) }}
@endif
@php

use App\Enums\UserRoles;
@endphp
</head>
<body class="nk-body npc-cryptlite bg-white{{ ($admins) ? ' admin-logged' : '' }}">
<div class="nk-app-root">
    <div class="nk-main">
        <header class="header bg-white border-bottom border-bottom-light">
            <div class="header-main header-light bg-white on-light is-sticky is-transparent">
                <div class="container header-container wide-lg">
                    <div class="header-wrap">

                        {{ site_branding('header', ['panel' => 'public', 'size' => 'md']) }}

                        <div class="header-toggle">
                            <button class="menu-toggler" data-target="main-hmenu">
                                <em class="menu-on icon ni ni-menu"></em>
                                <em class="menu-off icon ni ni-cross"></em>
                            </button>
                        </div>

                        <nav class="header-menu"  data-content="main-hmenu">
                            <ul class="menu-list ml-lg-auto">
                                @if(gss('front_page_enable', 'yes')=='yes')
                                <li class="menu-item"><a href="{{ url('/') }}" class="menu-link nav-link">{{ __("Home") }}</a></li>
                                @elseif (!empty(gss('main_website')))
                                <li class="menu-item">
                                    <a href="{{ gss('main_website') }}" target="_blank" class="menu-link nav-link">
                                        <span>{{ __("Main Website") }}</span>
                                        <em class="icon ni ni-external pl-1"></em>
                                    </a>
                                </li>
                                @endif
                                @if(gss('invest_page_enable', 'yes')=='yes')
                                <li class="menu-item"><a href="{{ route('investments') }}" class="menu-link nav-link">{{ __("Investment") }}</a></li>
                                @endif
                                {!! Panel::navigation('mainnav') !!}

                                @if (!auth()->check() && gss('signup_allow', 'enable') == 'enable')
                                <li class="menu-item"><a href="{{ route('auth.register.form') }}" class="menu-link nav-link">{{ __("Register") }}</a></li>
                                @endif
                            </ul>

                            @if (auth()->check())
                            <ul class="nk-quick-nav ml-1">
                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                <em class="icon ni ni-user-alt"></em>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                    <span>{!! user_avatar(auth()->user()) !!}</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{ auth()->user()->display_name }}</span>
                                                    <span class="sub-text">{{ auth()->user()->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="{{ (auth()->user()->role==UserRoles::USER) ? route('dashboard') : route('admin.dashboard') }}"><em class="icon ni ni-dashboard"></em><span>{{ __('Go to Dashboard') }}</span></a></li>
                                                <li><a href="{{ (auth()->user()->role==UserRoles::USER) ? route('account.profile') : route('admin.profile.view')  }}"><em class="icon ni ni-user-alt"></em><span>{{ __('View Profile') }}</span></a></li>
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li>
                                                    <a href="{{ route('auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <em class="icon ni ni-signout"></em><spean>{{ __('Sign out') }}</spean></a>
                                                </li>
                                            </ul>
                                            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            @else
                            <ul class="menu-btns">
                                <li>
                                    <a href="{{ route('auth.login.form') }}" class="btn btn-round btn-primary"><em class="icon ni ni-user-alt"></em> <span>{{ __("Login") }}</span></a>
                                </li>
                            </ul>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <div class="nk-page-content bg-lighter">
            @if(is_route('welcome'))
                @yield('content')
            @else
            <section class="section section-lg section-page">
                <div class="container wide-lg">
                    @yield('content')
                </div>
            </section>
            @endif
        </div>

        @include('frontend.layouts.footer')
    </div>
</div>

@stack('modal')

<script src="{{ asset('/assets/js/bundle.js') }}"></script>
<script src="{{ asset('/assets/js/app.js') }}"></script>
<script src="{{ asset('/assets/js/main_script.js') }}"></script>
<script src="{{ asset('/assets/js/plugin.js') }}"></script>
<script src="{{ asset('/assets/slider/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/slider/custom.js') }}"></script>

@stack('scripts')

@if(sys_settings('footer_code'))
    {{ html_string(sys_settings('footer_code')) }}
@endif
</body>
</html>
