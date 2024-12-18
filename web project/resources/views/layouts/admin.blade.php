<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-white dark:bg-gray-900 bg-cover flex flex-col min-h-screen">
    <header>
        <x-header />
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <x-footer />
    </footer>
</body>
</html>
