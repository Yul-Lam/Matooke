<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer | Golden Bean Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #5a7247, #8b5a2b);">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('customer.dashboard') }}">Golden Bean - Customer</a>
            <div>
                <a href="{{ route('customer.cart') }}" class="btn btn-sm btn-outline-light me-2">
                    <i class="fas fa-shopping-cart"></i> Cart
                </a>
                <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-light"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    <main class="container mt-4">
        @yield('content')
    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
