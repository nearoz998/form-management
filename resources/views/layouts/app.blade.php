<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>

            @if (session('success'))
                <div class="bg-green-500 text-white p-4 mb-4 rounded-md shadow-md">
                    <strong>Success:</strong> {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-500 text-white p-4 mb-4 rounded-md shadow-md">
                    <strong>Error:</strong> {{ session('error') }}
                </div>
            @endif

            @if (session('warning'))
                <div class="bg-yellow-500 text-white p-4 mb-4 rounded-md shadow-md">
                    <strong>Warning:</strong> {{ session('warning') }}
                </div>
            @endif

            @if (session('info'))
                <div class="bg-blue-500 text-white p-4 mb-4 rounded-md shadow-md">
                    <strong>Info:</strong> {{ session('info') }}
                </div>
            @endif
            {{ $slot }}
        </main>
    </div>
</body>

</html>
