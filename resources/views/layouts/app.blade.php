<<<<<<< HEAD

<!-- filepath: resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ...other head content... -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>☕ Coffee Supply Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex" style="min-height: 100vh;">
    <!-- Sidebar -->
    <div class="bg-dark text-white p-3" style="width: 250px;">
        <h4 class="mb-4">📦 Supply Manager</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="{{ route('supplies.index') }}" class="nav-link text-white">📋 All Supplies</a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('supplies.create') }}" class="nav-link text-white">➕ Add Supply</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Coffee Dashboard</a>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="p-4">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
>>>>>>> 1b843c810ec3fd48d1bd3bcd733da4568b6c576f
