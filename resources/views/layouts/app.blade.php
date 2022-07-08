<!DOCTYPE html>
<html lang="en" class="h-screen">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ config('app.name') }}</title>

        <script src="https://cdn.tailwindcss.com"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <livewire:styles />

        <script src="{{ asset('vendor/shuttle/js/shuttle.js') }}"></script>
    </head>

    <body class="h-screen">
        {{ $slot }}

        <livewire:scripts />
    </body>
</html>
