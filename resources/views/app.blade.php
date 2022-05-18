<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia="title">{{ $title ?? 'FreeOnlineTools' }}</title>
        <meta inertia="description" name="description" content="{{ !empty($description) ? $description : 'Find a wide variety of online tools and calculators' }}" />

        <meta inertia="title" property="og:type" content="website" />
        <meta inertia="og:title" property="og:title" content=" {{ !empty($title) ? $title : 'FreeOnlineTools' }}" />
        <meta inertia="og:url" property="og:url" content="{{ URL::current(); }}" />
        <meta inertia="og:site_name" property="og:site_name" content="{{ config('name') }}" />
        <meta inertia="og:description" property="og:description" content="{{ !empty($description) ? $description : 'Find a wide variety of online tools and calculators' }}" />
        <meta inertia="og:image" property="og:image" content="{{ !empty($ogImage) ? asset('img/'.$ogImage) : asset('img/ogimage.jpg') }}" />
        <meta inertia="twitter:card" name="twitter:card" content="summary" />
        <meta inertia="twitter:title" name="twitter:title" content=" {{ !empty($title) ? $title : 'FreeOnlineTools' }}" />
        <meta inertia="twitter:description" name="twitter:description" content="{{ !empty($description) ? $description : 'Find a wide variety of online tools and calculators' }}" />
        <meta inertia="twitter:image" name="twitter:image:src" content="{{ !empty($ogImage) ? asset('img/'.$ogImage) : asset('img/ogimage.jpg') }}" />

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="{{ asset('assets/fontawesome-pro/css/all.min.css') }}" rel="stylesheet" />
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

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
