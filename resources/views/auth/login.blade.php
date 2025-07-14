<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Golden Bean | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
           
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(3px);
        }

        .login-card {
            background: rgba(255, 253, 250, 0.96);
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
        }

        .login-title {
            font-size: 28px;
            font-weight: 700;
            color: #4b371c;
        }

        .coffee-brand {
            background: linear-gradient(135deg, #8b5a2b, #5a7247);
            color: white;
            font-size: 26px;
            padding: 15px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .btn-coffee {
            background: linear-gradient(135deg, #8b5a2b, #5a7247);
            color: #fff;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-coffee:hover {
            background: linear-gradient(135deg, #5a7247, #8b5a2b);
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(139, 90, 43, 0.2);
            border-color: #8b5a2b;
        }

        .text-small {
            font-size: 14px;
        }

        .login-footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #6c757d;
        }

        .login-footer a {
            color: #5a7247;
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .divider {
            position: relative;
            text-align: center;
            margin: 30px 0;
        }

        .divider::before, .divider::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background-color: #ccc;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        .divider span {
            color: #888;
            font-size: 14px;
            padding: 0 10px;
            background: #fffdfa;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-card text-center">

                    <div class="coffee-brand mx-auto">
                        <i class="fas fa-mug-hot"></i>
                    </div>

                    <h1 class="login-title mb-2">Golden Bean Portal</h1>
                    <p class="text-muted mb-4">Uganda’s Premium Coffee Product</p>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3 text-start">
                            <label for="email" class="form-label text-small">Email Address</label>
                            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required autofocus placeholder="you@example.com">
                            @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3 text-start">
                            <label for="password" class="form-label text-small">Password</label>
                            <input id="password" type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   required placeholder="••••••••">
                            @error('password')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                <label class="form-check-label text-small" for="remember">Remember me</label>
                            </div>
                            <a href="{{ route('password.request') }}" class="text-small">Forgot password?</a>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-coffee">
                                <i class="fas fa-sign-in-alt me-2"></i> Log In
                            </button>
                        </div>
                    </form>

                    <div class="divider"><span>or</span></div>

                    <div class="d-flex justify-content-center gap-3">
                        <a href="#" class="btn btn-outline
