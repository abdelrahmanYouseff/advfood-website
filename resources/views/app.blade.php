<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Open Graph Meta Tags --}}
        <meta property="og:title" content="ADVFood - منصة طلب الطعام">
        <meta property="og:description" content="اكتشف أفضل المطاعم واطلب طعامك المفضل مع ADVFood">
        <meta property="og:image" content="{{ asset('favicon_copy.png') }}">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="ADVFood">

        {{-- Twitter Card Meta Tags --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="ADVFood - منصة طلب الطعام">
        <meta name="twitter:description" content="اكتشف أفضل المطاعم واطلب طعامك المفضل مع ADVFood">
        <meta name="twitter:image" content="{{ asset('favicon_copy.png') }}">

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        {{-- Inline style to set the HTML background color based on our theme in app.css --}}
        <style>
            html {
                background-color: oklch(1 0 0);
            }

            html.dark {
                background-color: oklch(0.145 0 0);
            }
        </style>

        <title inertia>ADVFood - منصة طلب الطعام</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="shortcut icon" href="/favicon.ico">
        <meta name="msapplication-TileImage" content="/favicon.ico">
        <meta name="msapplication-TileColor" content="#cf4823">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @routes
        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
