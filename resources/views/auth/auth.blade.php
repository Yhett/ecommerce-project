<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NextMart - Login / Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --auth-primary: #ba68c8;
            --auth-secondary: #9c27b0;
            --auth-dark: #47215e;
            --auth-border: #ead7f1;
            --auth-soft: #fbf6fd;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(255, 255, 255, 0.55), transparent 34%),
                linear-gradient(135deg, #f7ebfb 0%, #e4d1f0 45%, #d6bce7 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .auth-shell {
            width: 100%;
            max-width: 1080px;
        }

        .auth-card {
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 32px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(18px);
            box-shadow: 0 30px 60px rgba(88, 33, 116, 0.16);
        }

        .auth-showcase {
            background:
                linear-gradient(160deg, rgba(71, 33, 94, 0.95), rgba(156, 39, 176, 0.82)),
                linear-gradient(135deg, #6a1b9a, #ba68c8);
            color: white;
            padding: 3rem;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .auth-showcase::before,
        .auth-showcase::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
        }

        .auth-showcase::before {
            width: 220px;
            height: 220px;
            top: -70px;
            right: -70px;
        }

        .auth-showcase::after {
            width: 180px;
            height: 180px;
            bottom: -60px;
            left: -40px;
        }

        .auth-brand {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 0.9rem;
            margin-bottom: 2rem;
        }

        .auth-brand-badge {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 1.45rem;
        }

        .auth-showcase h1 {
            position: relative;
            z-index: 1;
            font-size: 2.3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .auth-showcase p {
            position: relative;
            z-index: 1;
            color: rgba(255, 255, 255, 0.86);
            font-size: 1rem;
            max-width: 420px;
            margin-bottom: 1.8rem;
        }

        .auth-feature-list {
            position: relative;
            z-index: 1;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .auth-feature-list li {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            color: rgba(255, 255, 255, 0.92);
        }

        .auth-feature-list i {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.16);
        }

        .auth-panel {
            padding: 2.5rem;
        }

        .auth-panel-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .auth-panel-top h2 {
            color: var(--auth-dark);
            font-weight: 700;
            margin-bottom: 0.2rem;
        }

        .auth-panel-top p {
            color: #7a6b84;
            margin-bottom: 0;
        }

        .auth-home-link {
            color: var(--auth-secondary);
            text-decoration: none;
            font-weight: 600;
        }

        .auth-tabs {
            display: inline-flex;
            gap: 0.5rem;
            padding: 0.4rem;
            border-radius: 999px;
            background: #f4e8f8;
            margin-bottom: 1.75rem;
        }

        .auth-tabs button {
            border: none;
            border-radius: 999px;
            background: transparent;
            color: #7b6790;
            padding: 0.75rem 1.35rem;
            min-width: 128px;
            font-weight: 700;
            transition: all 0.25s ease;
        }

        .auth-tabs button.active {
            background: linear-gradient(135deg, var(--auth-primary), var(--auth-secondary));
            color: white;
            box-shadow: 0 10px 24px rgba(156, 39, 176, 0.22);
        }

        .auth-section {
            display: none;
        }

        .auth-section.active {
            display: block;
        }

        .form-label {
            color: var(--auth-dark);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 1.5px solid var(--auth-border);
            border-radius: 16px;
            background: var(--auth-soft);
            color: #382943;
            padding: 0.85rem 1rem;
        }

        .form-control::placeholder {
            color: #9b8aa6;
        }

        .form-control:focus {
            background: white;
            border-color: var(--auth-secondary);
            box-shadow: 0 0 0 0.2rem rgba(156, 39, 176, 0.12);
            color: #382943;
        }

        .form-check-label,
        .auth-muted {
            color: #7a6b84;
        }

        .btn-auth {
            background: linear-gradient(135deg, var(--auth-primary), var(--auth-secondary));
            border: none;
            border-radius: 16px;
            width: 100%;
            padding: 0.9rem 1rem;
            font-weight: 700;
            color: white;
            box-shadow: 0 12px 24px rgba(156, 39, 176, 0.2);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 30px rgba(156, 39, 176, 0.26);
            color: white;
        }

        .auth-inline {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin: 1rem 0 1.35rem;
            flex-wrap: wrap;
        }

        .auth-link {
            color: var(--auth-secondary);
            text-decoration: none;
            font-weight: 600;
        }

        .auth-link:hover,
        .auth-home-link:hover {
            color: #7f2d96;
        }

        .auth-password-tips {
            list-style: none;
            padding: 0;
            margin: 0.85rem 0 0;
            color: #7a6b84;
            font-size: 0.92rem;
        }

        .auth-password-tips li {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            margin-bottom: 0.4rem;
        }

        .auth-password-tips i {
            color: var(--auth-secondary);
        }

        .form-error {
            color: #c53030;
            font-size: 0.92rem;
            margin-top: 0.45rem;
        }

        .auth-alert {
            border: none;
            border-radius: 16px;
            padding: 0.95rem 1rem;
            margin-bottom: 1rem;
        }

        .auth-alert-success {
            background: #ecfdf3;
            color: #166534;
        }

        @media (max-width: 991px) {
            .auth-showcase {
                padding: 2rem;
            }

            .auth-panel {
                padding: 2rem 1.25rem;
            }
        }
    </style>
</head>
<body>
    <div class="auth-shell">
        <div class="auth-card">
            <div class="row g-0">
                <div class="col-lg-5">
                    <div class="auth-showcase">
                        <div class="auth-brand">
                            <div class="auth-brand-badge">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <div>
                                <div class="fw-bold fs-4">NextMart</div>
                                <div class="small text-white-50">Shop with style and ease</div>
                            </div>
                        </div>

                        <h1>Your next favorite look starts here.</h1>
                        <p>Sign in to continue shopping or create an account to save your cart, track updates, and manage your profile in one place.</p>

                        <ul class="auth-feature-list">
                            <li><i class="fas fa-check"></i> Faster checkout and saved account details</li>
                            <li><i class="fas fa-bell"></i> Notifications for order updates and store activity</li>
                            <li><i class="fas fa-user-shield"></i> Secure access to your profile and purchases</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="auth-panel">
                        <div class="auth-panel-top">
                            <div>
                                <h2>Account Access</h2>
                                <p>Login or create your account to continue.</p>
                            </div>
                            <a href="/" class="auth-home-link">
                                <i class="fas fa-arrow-left me-1"></i> Home
                            </a>
                        </div>

                        @if (session('status'))
                            <div class="auth-alert auth-alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="auth-tabs">
                            <button id="login-tab" type="button" class="btn btn-sm active">Login</button>
                            <button id="register-tab" type="button" class="btn btn-sm">Register</button>
                        </div>

                        <div id="login-section" class="auth-section active">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="login-email" class="form-label">Email Address</label>
                                    <input id="login-email" type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
                                    @error('email')<div class="form-error">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="login-password" class="form-label">Password</label>
                                    <input id="login-password" type="password" name="password" class="form-control" placeholder="Enter your password" required>
                                    @error('password')<div class="form-error">{{ $message }}</div>@enderror
                                </div>

                                <div class="auth-inline">
                                    <div class="form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                        <label class="form-check-label" for="remember">Remember me</label>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="auth-link">Forgot password?</a>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-auth">Sign In</button>
                            </form>
                        </div>

                        <div id="register-section" class="auth-section">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="register-name" class="form-label">Full Name</label>
                                    <input id="register-name" type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter your full name" required>
                                    @error('name')<div class="form-error">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="register-email" class="form-label">Email Address</label>
                                    <input id="register-email" type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email" required>
                                    @error('email')<div class="form-error">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="register-password" class="form-label">Password</label>
                                    <input id="register-password" type="password" name="password" class="form-control" placeholder="Create a password" required>
                                    @error('password')<div class="form-error">{{ $message }}</div>@enderror

                                    <ul class="auth-password-tips">
                                        <li><i class="fas fa-check-circle"></i> At least 8 characters</li>
                                        <li><i class="fas fa-check-circle"></i> Use upper and lowercase letters</li>
                                        <li><i class="fas fa-check-circle"></i> Add a number or symbol for stronger security</li>
                                    </ul>
                                </div>

                                <div class="mb-4">
                                    <label for="register-password-confirmation" class="form-label">Confirm Password</label>
                                    <input id="register-password-confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                                </div>

                                <button type="submit" class="btn btn-auth">Create Account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const loginTab = document.getElementById('login-tab');
        const registerTab = document.getElementById('register-tab');
        const loginSection = document.getElementById('login-section');
        const registerSection = document.getElementById('register-section');

        function showSection(section) {
            if (section === 'login') {
                loginTab.classList.add('active');
                registerTab.classList.remove('active');
                loginSection.classList.add('active');
                registerSection.classList.remove('active');
            } else {
                loginTab.classList.remove('active');
                registerTab.classList.add('active');
                loginSection.classList.remove('active');
                registerSection.classList.add('active');
            }
        }

        loginTab.addEventListener('click', () => showSection('login'));
        registerTab.addEventListener('click', () => showSection('register'));

        @if(isset($active) && $active === 'register')
            showSection('register');
        @endif
    </script>
</body>
</html>
