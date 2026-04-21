<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PPID Beltim') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/accessibility@1.1.2/dist/accessibility.min.js"></script>
        <script>
            window.addEventListener('load', function() {
                new Accessibility({
                    labels: {
                        reset: 'Atur Ulang',
                        makeTextBigger: 'Perbesar Teks',
                        makeTextSmaller: 'Perkecil Teks',
                        mainMenuTitle: 'Sarana Aksesibilitas',
                        grayscale: 'Skala Abu-abu',
                        highContrast: 'Kontras Tinggi',
                        negativeContrast: 'Latar Gelap',
                        lightContrast: 'Latar Terang',
                        readableFont: 'Tulisan Dapat Dibaca',
                        underlineLinks: 'Garis Bawahi Tautan',
                        textToSpeech: 'Moda Suara',
                        increaseCursor: 'Perbesar Kursor'
                    },
                    textToSpeechLang: 'id-ID', // Setting suara ke Bahasa Indonesia
                    showHiddenAttributes: true
                });
            }, false);
        </script>
    </body>
</html>