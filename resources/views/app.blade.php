<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}" />
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}" />
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}" />
        <link rel="mask-icon" href="{{ asset('assets/img/favicons/safari-pinned-tab.svg') }}" color="#5bbad5" />
        <link rel="shortcut icon" href="{{ asset('assets/img/favicons/favicon.ico') }}" />
        <meta name="msapplication-TileColor" content="#da532c" />
        <meta name="msapplication-config" content="{{ asset('assets/img/favicons/browserconfig.xml') }}" />
        <meta name="theme-color" content="#ffffff" />
        
        <title inertia="title">{{ $title ?? 'FreeOnlineTools' }}</title>
        <meta inertia="description" name="description" content="{{ !empty($description) ? $description : 'Find a wide variety of online tools and calculators' }}" />

        <meta inertia="title" property="og:type" content="website" />
        <meta inertia="og:title" property="og:title" content=" {{ !empty($title) ? $title : 'FreeOnlineTools' }}" />
        <meta inertia="og:url" property="og:url" content="{{ URL::current(); }}" />
        <meta inertia="og:site_name" property="og:site_name" content="{{ config('name') }}" />
        <meta inertia="og:description" property="og:description" content="{{ !empty($description) ? $description : 'Find a wide variety of online tools and calculators' }}" />
        <meta inertia="og:image" property="og:image" content="{{ !empty($ogImage) ? asset('assets/img/'.$ogImage) : asset('assets/img/ogImage.png') }}" />
        <meta inertia="twitter:card" name="twitter:card" content="summary" />
        <meta inertia="twitter:title" name="twitter:title" content=" {{ !empty($title) ? $title : 'FreeOnlineTools' }}" />
        <meta inertia="twitter:description" name="twitter:description" content="{{ !empty($description) ? $description : 'Find a wide variety of online tools and calculators' }}" />
        <meta inertia="twitter:image" name="twitter:image:src" content="{{ !empty($ogImage) ? asset('assets/img/'.$ogImage) : asset('assets/img/ogImage.png') }}" />

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="{{ asset('assets/fontawesome-pro/css/all.min.css') }}" rel="stylesheet" />
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZMED8XVFVT"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-ZMED8XVFVT');
        </script>
    
        @if(Route::currentRouteName() == "tools.loan-calculator.show")
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1973975964782893"
        crossorigin="anonymous"></script>
        @endif

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia

        @env ('local')
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        @endenv
    </body>
</html>
