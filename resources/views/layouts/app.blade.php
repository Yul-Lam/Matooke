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
