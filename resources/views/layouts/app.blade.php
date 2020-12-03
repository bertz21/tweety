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
        <section class="px-8 py-4">
            <header class="container mx-auto">
                <h1><img src="/images/logo.svg" alt="Tweety" class="w-15" style="width: 100px;"></h1>
            </header>
        </section>
        <section class="px-8">
            <main class="container mx-auto">
                <div class="lg:flex lg:justify-center">
                    @if(auth()->check())
                        <div class="lg:w-32">
                            @include('_sidebar-links')
                        </div>
                    @endif

                    <div class="lg:flex-1 lg:mx-10" style="max-width:700px;">
                        @yield('content')
                    </div>
                    
                    @if(auth()->check())
                        <div class="lg:w-1/6 bg-blue-100 rounded-lg p-4">
                            @include('_friends-list')
                        </div>  
                    @endif 
                </div>


            </main>
        </section>
    </div>
</body>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
</html>
