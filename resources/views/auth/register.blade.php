<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NextMart - Register</title>
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
            padding: 20px;
        }

        .register-container {
            width: 100%;
            max-width: 500px;
        }

        .register-card {
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
            color: #9c27b0;
            margin-right: 8px;
        }

        .logo h2 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            color: #6a1b9a;
        }

        .logo p {
            margin: 8px 0 0 0;
            color: #999;
            font-size: 14px;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .form-group {
            margin-bottom: 18px;
            animation: slideUp 0.5s ease-out both;
        }

        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control {
            background: #f8f8f8;
            border: 1.5px solid #e1bee7;
            color: #333;
            border-radius: 12px;
            padding: 11px 14px;
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

        .btn-register {
            background: linear-gradient(135deg, #ba68c8, #ab47bc);
            border: none;
            border-radius: 12px;
            padding: 13px 24px;
            width: 100%;
            font-weight: 700;
            color: white;
            font-size: 16px;
            transition: all 0.3s ease;
            margin-top: 15px;
            margin-bottom: 15px;
            box-shadow: 0 8px 20px rgba(156, 39, 176, 0.2);
            animation: slideUp 0.5s ease-out 0.6s both;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(156, 39, 176, 0.3);
            color: white;
        }

        .btn-register:active {
            transform: translateY(-1px);
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            color: #999;
            font-size: 13px;
            animation: fadeIn 0.5s ease-out 0.7s both;
        }

        .divider::before,
        .divider::after {
            content: '';
            display: inline-block;
            width: 42%;
            height: 1px;
            background: #ddd;
            vertical-align: middle;
        }

        .divider::before { margin-right: 10px; }
        .divider::after { margin-left: 10px; }

        .login-link {
            text-align: center;
            font-size: 15px;
            color: #666;
            animation: slideUp 0.5s ease-out 0.8s both;
        }

        .login-link a {
            color: #9c27b0;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            text-decoration: underline;
            color: #6a1b9a;
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

        .password-requirements {
            font-size: 12px;
            color: #666;
            margin-top: 6px;
            padding: 8px 12px;
            background: #f3e5f5;
            border-left: 3px solid #9c27b0;
            border-radius: 4px;
        }

        .password-requirements li {
            margin: 3px 0;
            list-style: none;
            padding-left: 20px;
            position: relative;
        }

        .password-requirements li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #9c27b0;
        }

        .back-home {
            text-align: center;
            margin-top: 15px;
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
            .register-card {
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
    <div class="register-container">
        <div class="register-card">
            <div class="logo">
                <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                    <i class="fas fa-user-plus"></i>
                    <h2>Create Account</h2>
                </div>
                <p>Join NextMart today</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="fas fa-user"></i> Full Name
                    </label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                           name="name" value="{{ old('name') }}" placeholder="Enter your full name" required autofocus>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i> Email Address
                    </label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
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
                           name="password" placeholder="Create a strong password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <ul class="password-requirements">
                        <li>At least 8 characters long</li>
                        <li>Mix of uppercase and lowercase</li>
                        <li>Include numbers and symbols</li>
                    </ul>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        <i class="fas fa-check-circle"></i> Confirm Password
                    </label>
                    <input id="password_confirmation" type="password" class="form-control" 
                           name="password_confirmation" placeholder="Confirm your password" required>
                </div>

                <button type="submit" class="btn btn-register">
                    <i class="fas fa-user-plus"></i> Create Account
                </button>
            </form>

            <div class="divider">Already have an account?</div>

            <div class="login-link">
                <a href="{{ route('login') }}">Sign in instead</a>
            </div>

            <div class="back-home">
                <a href="/"><i class="fas fa-arrow-left"></i> Back to Home</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
