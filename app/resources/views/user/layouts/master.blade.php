<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | {{ site_info('name') }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/apps.css?ver=1.0.0') }}">
@if(sys_settings('ui_theme_skin', 'default')!='default')
    <link rel="stylesheet" href="{{ asset('assets/css/skins/theme-'.sys_settings('ui_theme_skin').'.css?ver=1.0.0') }}">
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
</head>
<body class="nk-body npc-cryptlite has-sidebar has-sidebar-fat">
<div class="nk-app-root">
    <div class="nk-main">
        @include('user.layouts.sidebar')

        <div class="nk-wrap">

            @include('user.layouts.header')

            <div class="nk-content nk-content-fluid">
                <div class="container-xl wide-lg">
                    
                    @include('misc.notices')

                    @yield('content')

                </div>
            </div>

            @include('user.layouts.footer')

        </div>
    </div>
</div>

@stack('modal')
@if(sys_settings('custom_stylesheet')=='on')
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
@endif
<script src="{{ asset('/assets/js/bundle.js') }}"></script>
<script src="{{ asset('/assets/js/app.js') }}"></script>
<script src="{{ asset('/assets/js/charts.js') }}"></script>
<!-- Start of LiveChat (www.livechat.com) code -->
<script>
    window.__lc = window.__lc || {};
    window.__lc.license = 14388270;
    ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
</script>
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/628d8ee4b0d10b6f3e73e28b/1g3sfcblt';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
<!-- End of LiveChat code -->
<script type="text/javascript">
    const updateSetting = "{{ route('update.setting') }}", getTnxDetails = "{{ route('transaction.details') }}";
</script>
@stack('scripts')
@if(sys_settings('footer_code'))
    {{ html_string(sys_settings('footer_code')) }}
@endif
</body>
</html>