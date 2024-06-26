<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'YourExpenseApp')</title>
        <link rel="icon" href="{{ asset('storage/images/logo/logo.jpeg') }}" type="image/jpeg"/>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans bg-gray-200 text-gray-900 antialiased">
        @include('layouts.navigation')

                    <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-purple-800/90 shadow rounded-b-md mb-10">
                <div class="max-w-7xl text-center mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <div class="flex py-48 flex-col sm:justify-center items-center sm:pt-0">
            <div>
                <a href="/">
                    <x-application-logo text-color-class="text-gray-800" class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-purple-800/90 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

        <x-footer/>
    </body>
</html>
