<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NextMart Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --admin-bg: #f6f2fa;
            --admin-panel: #ffffff;
            --admin-sidebar: #1f1630;
            --admin-sidebar-soft: #2e2242;
            --admin-primary: #9c27b0;
            --admin-primary-soft: #f1dff6;
            --admin-text: #2e2238;
            --admin-muted: #7a7085;
            --admin-border: #ebdff1;
            --admin-danger: #c2414d;
            --admin-success: #198754;
            --admin-shadow: 0 18px 40px rgba(82, 36, 102, 0.08);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: radial-gradient(circle at top left, rgba(255,255,255,0.85), transparent 30%), var(--admin-bg);
            color: var(--admin-text);
        }

        .admin-shell {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--admin-sidebar) 0%, #170f25 100%);
            color: white;
            padding: 28px 22px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            margin-bottom: 2rem;
        }

        .admin-brand-badge {
            width: 52px;
            height: 52px;
            border-radius: 18px;
            background: linear-gradient(135deg, #c76cdb, #8f24a5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            box-shadow: 0 14px 28px rgba(156, 39, 176, 0.2);
        }

        .admin-brand h1 {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .admin-brand p {
            color: rgba(255,255,255,0.65);
            font-size: 0.85rem;
        }

        .sidebar-nav {
            display: grid;
            gap: 0.6rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.95rem 1rem;
            border-radius: 16px;
            text-decoration: none;
            color: rgba(255,255,255,0.82);
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: rgba(255,255,255,0.08);
            color: white;
            transform: translateX(4px);
        }

        .sidebar-link i {
            width: 18px;
            text-align: center;
        }

        .main {
            margin-left: 280px;
            width: calc(100% - 280px);
            padding: 28px;
        }

        .topbar {
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.9);
            border-radius: 24px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--admin-shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .topbar h2 {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--admin-text);
        }

        .topbar p {
            color: var(--admin-muted);
            font-size: 0.92rem;
            margin-top: 0.15rem;
        }

        .admin-userbox {
            display: flex;
            align-items: center;
            gap: 0.9rem;
        }

        .admin-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, #c76cdb, #8f24a5);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .card {
            background: var(--admin-panel);
            border: 1px solid var(--admin-border);
            border-radius: 24px;
            padding: 1.5rem;
            box-shadow: var(--admin-shadow);
        }

        .btn,
        button,
        input[type="submit"] {
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #c76cdb, #9c27b0);
            color: white;
            padding: 0.8rem 1rem;
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 10px 20px rgba(156, 39, 176, 0.18);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
        }

        .btn:hover,
        button:hover,
        input[type="submit"]:hover {
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #fff;
            color: var(--admin-primary);
            border: 1px solid var(--admin-border);
            box-shadow: none;
        }

        .btn-danger {
            background: #fff1f2;
            color: var(--admin-danger);
            border: 1px solid #f4c7cd;
            box-shadow: none;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 0.85rem 0.95rem;
            margin-bottom: 0.9rem;
            border-radius: 16px;
            border: 1.5px solid var(--admin-border);
            background: #fcfafe;
            color: var(--admin-text);
            outline: none;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: var(--admin-primary);
            box-shadow: 0 0 0 0.2rem rgba(156, 39, 176, 0.1);
            background: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            color: var(--admin-muted);
            font-size: 0.9rem;
            font-weight: 600;
            padding: 0 0 1rem;
        }

        td {
            padding: 1rem 0;
            border-top: 1px solid var(--admin-border);
            vertical-align: middle;
        }

        .table-actions {
            display: flex;
            gap: 0.6rem;
            flex-wrap: wrap;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.35rem;
        }

        .page-subtitle {
            color: var(--admin-muted);
            margin-bottom: 1.25rem;
        }

        .flash-success {
            background: #ecfdf3;
            color: var(--admin-success);
            border: 1px solid #c6f6d5;
            padding: 0.95rem 1rem;
            border-radius: 16px;
            margin-bottom: 1rem;
        }

        @media (max-width: 992px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .admin-shell {
                flex-direction: column;
            }

            .main {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
<div class="admin-shell">
    <aside class="sidebar">
        <div class="admin-brand">
            <div class="admin-brand-badge">
                <i class="fas fa-store"></i>
            </div>
            <div>
                <h1>NextMart Admin</h1>
                <p>Store management panel</p>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="/admin" class="sidebar-link {{ request()->is('admin') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="/admin/products" class="sidebar-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                <i class="fas fa-box-open"></i>
                <span>Products</span>
            </a>
            <a href="/admin/users" class="sidebar-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Users</span>
            </a>
            <a href="/admin/orders" class="sidebar-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
                <i class="fas fa-truck-fast"></i>
                <span>Orders</span>
            </a>
        </nav>
    </aside>

    <main class="main">
        <div class="topbar">
            <div>
                <h2>@yield('admin_title', 'Admin Dashboard')</h2>
                <p>@yield('admin_subtitle', 'Manage products, users, and store activity from one place.')</p>
            </div>

            <div class="admin-userbox">
                <div class="admin-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <div style="font-weight: 600;">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" style="background:none;border:none;box-shadow:none;padding:0;color:var(--admin-primary);font-weight:600;">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        @yield('content')
    </main>
</div>
</body>
</html>
