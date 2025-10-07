<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $meta = $meta ?? [];
        $title = $meta['title'] ?? 'ADVFood - منصة طلب الطعام';
        $description = $meta['description'] ?? 'اكتشف أفضل المطاعم واطلب طعامك المفضل مع ADVFood';
        // استخدم صورة PNG/JPG ثابتة في public/favicon copy.png
        $defaultImagePath = 'favicon copy.png';
        // لو الملف موجود في public نستخدم secure_asset للحصول على رابط كامل HTTPS
        $imagePath = $meta['image'] ?? (file_exists(public_path($defaultImagePath)) ? secure_asset($defaultImagePath) : secure_asset('logo-white.png'));
        // لتفادي الكاش أثناء التطوير/تحديث: يمكنك فك التعليق التالي لو الصورة في public
        // if (file_exists(public_path($defaultImagePath))) { $imagePath .= '?v=' . filemtime(public_path($defaultImagePath)); }
        $url = $meta['url'] ?? url()->current();
    @endphp

    {{-- Basic SEO / OG --}}
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ $url }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ADVFood">

    {{-- Image (use PNG/JPG not SVG) --}}
    <meta property="og:image" content="{{ $imagePath }}">
    <meta property="og:image:secure_url" content="{{ $imagePath }}">
    <meta property="og:image:type" content="{{ \Illuminate\Support\Str::contains($imagePath, '.jpg') || \Illuminate\Support\Str::contains($imagePath, '.jpeg') ? 'image/jpeg' : 'image/png' }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="ADVFood - اطلب طعامك المفضل">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $imagePath }}">

    <link rel="canonical" href="{{ $url }}">
    <title inertia>{{ $title }}</title>

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

    {{-- dark-mode immediate script (خليه بعد الميتا عادي) --}}
    <script>
        (function() {
            const appearance = '{{ $appearance ?? "system" }}';
            if (appearance === 'system') {
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (prefersDark) document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <style>
        html { background-color: oklch(1 0 0); }
        html.dark { background-color: oklch(0.145 0 0); }
    </style>
</head>
