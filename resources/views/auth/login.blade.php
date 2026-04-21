<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NextMart - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #ba68c8;
            --secondary-color: #ab47bc;
            --accent-color: #9c27b0;
        }

        body {
            background: linear-gradient(135deg, #f5f5f5 0%, #e8dff5 100%);
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .login-card {
            background: white;
            backdrop-filter: none;
            border: 2px solid #e1bee7;
            border-radius: 20px;
            padding: 45px 35px;
            box-shadow: 0 20px 60px rgba(156, 39, 176, 0.15);
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            text-align: center;
            margin-bottom: 35px;
            animation: fadeIn 0.6s ease-out 0.1s both;
        }

        .logo i {
            font-size: 45px;
            margin-right: 12px;
            color: #9c27b0;
        }

        .logo h2 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            color: #6a1b9a;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .form-group {
            margin-bottom: 20px;
            animation: slideUp 0.5s ease-out both;
        }

        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #555;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control {
            background: #f8f8f8;
            border: 1.5px solid #e1bee7;
            color: #333;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: #999;
        }

        .form-control:focus {
            background: white;
            border-color: #9c27b0;
            box-shadow: 0 0 0 3px rgba(156, 39, 176, 0.1);
            color: #333;
        }

        .form-check {
            margin-bottom: 20px;
            animation: slideUp 0.5s ease-out 0.4s both;
        }

        .form-check-input {
            background: white;
            border: 1px solid #ddd;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-check-input:checked {
            background: #9c27b0;
            border-color: #9c27b0;
        }

        .form-check-label {
            color: #666;
            margin-left: 8px;
            cursor: pointer;
        }

        .btn-login {
            background: linear-gradient(135deg, #ba68c8, #ab47bc);
            border: none;
            border-radius: 12px;
            padding: 13px 24px;
            width: 100%;
            font-weight: 700;
            color: white;
            font-size: 16px;
            transition: all 0.3s ease;
            margin-top: 10px;
            margin-bottom: 15px;
            box-shadow: 0 8px 20px rgba(156, 39, 176, 0.2);
            animation: slideUp 0.5s ease-out 0.5s both;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(156, 39, 176, 0.3);
            color: white;
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .form-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 14px;
            animation: slideUp 0.5s ease-out 0.6s both;
        }

        .form-links a {
            color: #9c27b0;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .form-links a:hover {
            color: #6a1b9a;
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            color: #999;
            font-size: 13px;
            animation: fadeIn 0.5s ease-out 0.7s both;
        }

        .divider::before,
        .divider::after {
            content: '';
            display: inline-block;
            width: 45%;
            height: 1px;
            background: #ddd;
            vertical-align: middle;
        }

        .divider::before { margin-right: 10px; }
        .divider::after { margin-left: 10px; }

        .register-link {
            text-align: center;
            font-size: 15px;
            color: #666;
            animation: slideUp 0.5s ease-out 0.8s both;
        }

        .register-link a {
            color: #9c27b0;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .register-link a:hover {
            text-decoration: underline;
            color: #6a1b9a;
        }

        .alert {
            border-radius: 12px;
            border: none;
            margin-bottom: 20px;
            padding: 12px 16px;
            font-size: 14px;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background: rgba(255, 107, 107, 0.15);
            border-left: 4px solid #ff6b6b;
            color: #d63031;
        }

        .alert-success {
            background: rgba(46, 213, 115, 0.15);
            border-left: 4px solid #2ed573;
            color: #27ae60;
        }

        .text-danger {
            font-size: 13px;
            color: #d63031;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .text-danger::before {
            content: '⚠';
        }

        .back-home {
            text-align: center;
            margin-top: 20px;
            animation: fadeIn 0.5s ease-out 0.9s both;
        }

        .back-home a {
            color: #9c27b0;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .back-home a:hover {
            color: #6a1b9a;
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 30px 20px;
            }

            .logo h2 {
                font-size: 24px;
            }

            .logo i {
                font-size: 35px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo">
                <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                    <i class="fas fa-shopping-bag"></i>
                    <h2>NextMart</h2>
                </div>
                <p style="margin: 8px 0 0 0; color: rgba(255, 255, 255, 0.7); font-size: 14px;">Welcome Back</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i> Email Address
                    </label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                           name="password" placeholder="Enter your password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember & Forgot -->
                <div class="form-links">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </button>
            </form>

            <div class="divider">Don't have an account?</div>

            <div class="register-link">
                <a href="{{ route('register') }}">Create one now</a>
            </div>

            <div class="back-home">
                <a href="/"><i class="fas fa-arrow-left"></i> Back to Home</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
