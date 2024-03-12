@props([
    'title' => null,
    'meta' => null,
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @isset($title)
            {{ $title }} |
        @endisset
        {{ config('app.name', '__NAME_NOT_SET__') }}
    </title>

    {!! $meta ?? '' !!}

    <!-- Fonts -->
    @include('layouts._fonts')

    <!-- Scripts -->
    @l10n
    <script type="module">
        import BugsnagPerformance from '//d2wy8f7a9ursnm.cloudfront.net/v1/bugsnag-performance.min.js'
        BugsnagPerformance.start({
            apiKey: '3fe3cba947b14c7c606e988ecdc3f882'
        })
    </script>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/css/editor.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased dark:bg-gray-900">
    <div class="min-h-screen">
        <livewire:layout.navigation />

        <!-- Page Content -->
        <div class="sm:pt-4 lg:px-8" {{ $attributes }}>
            {{ $slot }}
        </div>
    </div>

    @livewireScriptConfig
</body>

</html>
