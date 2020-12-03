<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <section class="px-8 py-4 mb-6">
            <header class="container mx-auto">
                <h1><img src="/images/logo.svg" alt="Tweety" class="w-15" style="width: 100px;"></h1>
            </header>
        </section>

        {{ $slot}}
        
    </div>
</body>
<!-- Scripts -->
<script src="http://unpkg.com/turbolinks"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
</html>
