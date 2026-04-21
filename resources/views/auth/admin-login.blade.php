<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NextMart Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            font-family: 'Poppins', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.18), transparent 30%),
                linear-gradient(135deg, #20162f 0%, #3d2152 55%, #7b2f93 100%);
        }

        .admin-login-shell {
            width: 100%;
            max-width: 980px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 28px 60px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(18px);
        }

        .admin-side {
            background: linear-gradient(180deg, rgba(26, 18, 38, 0.98), rgba(56, 29, 75, 0.95));
            color: white;
            padding: 3rem 2.4rem;
            height: 100%;
        }

        .admin-badge {
            width: 64px;
            height: 64px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #c76cdb, #8f24a5);
            font-size: 1.45rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 18px 30px rgba(156, 39, 176, 0.2);
        }

        .admin-side h1 {
            font-size: 2.1rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .admin-side p {
            color: rgba(255,255,255,0.78);
            margin-bottom: 1.5rem;
            line-height: 1.7;
        }

        .admin-side ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            gap: 0.9rem;
        }

        .admin-side li {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            color: rgba(255,255,255,0.88);
        }

        .admin-side li i {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.12);
        }

        .admin-form-wrap {
            background: rgba(255,255,255,0.94);
            padding: 3rem 2.4rem;
            height: 100%;
        }

        .admin-form-wrap h2 {
            color: #2e2238;
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .admin-form-wrap p {
            color: #7a7085;
            margin-bottom: 1.5rem;
        }

        .form-label {
            color: #4b3a57;
            font-weight: 600;
            margin-bottom: 0.45rem;
        }

        .form-control {
            border: 1.5px solid #ebdff1;
            border-radius: 16px;
            background: #fcfafe;
            padding: 0.9rem 1rem;
            color: #2e2238;
        }

        .form-control:focus {
            background: white;
            border-color: #9c27b0;
            box-shadow: 0 0 0 0.2rem rgba(156, 39, 176, 0.12);
            color: #2e2238;
        }

        .btn-admin-login {
            width: 100%;
            border: none;
            border-radius: 16px;
            padding: 0.95rem 1rem;
            background: linear-gradient(135deg, #c76cdb, #9c27b0);
            color: white;
            font-weight: 700;
            box-shadow: 0 14px 28px rgba(156, 39, 176, 0.2);
        }

        .admin-note {
            margin-top: 1.5rem;
            padding: 1rem;
            border-radius: 18px;
            background: #f8f0fb;
            border: 1px solid #ebdff1;
            color: #6a1b9a;
            font-size: 0.95rem;
        }

        .admin-links {
            margin-top: 1rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .admin-links a {
            color: #9c27b0;
            text-decoration: none;
            font-weight: 600;
        }

        .admin-error {
            color: #c2414d;
            font-size: 0.92rem;
            margin-top: 0.4rem;
        }

        @media (max-width: 992px) {
            .admin-side,
            .admin-form-wrap {
                padding: 2rem 1.4rem;
            }
        }
    </style>
</head>
<body>
    <div class="admin-login-shell">
        <div class="row g-0">
            <div class="col-lg-5">
                <div class="admin-side">
                    <div class="admin-badge">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h1>Admin Panel Access</h1>
                    <p>Sign in to manage products, users, featured items, and storefront activity from the NextMart control panel.</p>

                    <ul>
                        <li><i class="fas fa-chart-line"></i> Monitor store insights and activity</li>
                        <li><i class="fas fa-box-open"></i> Manage products and featured collections</li>
                        <li><i class="fas fa-users"></i> View and maintain registered user accounts</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="admin-form-wrap">
                    <h2>Admin Login</h2>
                    <p>Only the administrator account can sign in here.</p>

                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="username" class="form-label">Admin Username</label>
                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Enter admin username" required autofocus>
                            @error('username')
                                <div class="admin-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Enter password" required>
                            @error('password')
                                <div class="admin-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Keep me signed in</label>
                        </div>

                        <button type="submit" class="btn-admin-login">
                            <i class="fas fa-sign-in-alt me-2"></i> Log In as Admin
                        </button>
                    </form>

                    <div class="admin-note">
                        <strong>Admin credentials</strong><br>
                        Username: <code>Admin</code><br>
                        Password: <code>Admin123</code>
                    </div>

                    <div class="admin-links">
                        <a href="/login">User Login</a>
                        <a href="/">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
