<style>
    :root {
        --primary: #ba68c8;
        --secondary: #ab47bc;
        --accent: #9c27b0;
        --dark: #6a1b9a;
        --light-border: #e1bee7;
    }

    .navbar-home {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: linear-gradient(135deg, #ffffff 0%, #f3e5f5 100%);
        border-bottom: 2px solid var(--light-border);
        box-shadow: 0 8px 24px rgba(156, 39, 176, 0.12);
        z-index: 1000;
        padding: 0.75rem 2rem;
        backdrop-filter: blur(10px);
        animation: slideDown 0.5s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .navbar-home.scrolled {
        box-shadow: 0 12px 32px rgba(156, 39, 176, 0.18);
        padding: 0.5rem 2rem;
    }

    .navbar-home-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .navbar-brand-home {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--dark) !important;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .navbar-brand-home:hover {
        transform: scale(1.05);
        color: var(--accent) !important;
    }

    .navbar-brand-home i {
        font-size: 1.8rem;
        color: var(--accent);
        transition: transform 0.3s ease;
    }

    .navbar-brand-home:hover i {
        transform: rotate(10deg);
    }

    /* Search Container */
    .navbar-search {
        flex: 1;
        max-width: 400px;
    }

    .navbar-search input {
        width: 100%;
        padding: 10px 16px;
        border: 2px solid var(--light-border);
        border-radius: 25px;
        background: white;
        font-size: 14px;
        transition: all 0.3s ease;
        color: #555;
    }

    .navbar-search input::placeholder {
        color: #999;
    }

    .navbar-search input:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 12px rgba(156, 39, 176, 0.2);
        background: #fafafa;
    }

    /* Navbar Links */
    .navbar-links {
        display: flex;
        align-items: center;
        gap: 1rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .navbar-link {
        position: relative;
        text-decoration: none;
        color: #555;
        font-weight: 500;
        font-size: 14px;
        padding: 8px 0;
        transition: all 0.3s ease;
    }

    .navbar-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--primary), var(--accent));
        transition: width 0.3s ease;
    }

    .navbar-link:hover {
        color: var(--accent);
    }

    .navbar-link:hover::after {
        width: 100%;
    }

    .navbar-link.active {
        color: var(--accent);
    }

    .navbar-link.active::after {
        width: 100%;
    }

    /* Navbar Icons */
    .navbar-icons {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-left: 1rem;
    }

    .navbar-icon {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        border: 2px solid var(--light-border);
        color: #555;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 1.1rem;
    }

    .navbar-profile-visual {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        color: white;
        overflow: hidden;
    }

    .navbar-profile-visual img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .navbar-icon:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
        transform: scale(1.1) translateY(-2px);
        box-shadow: 0 8px 16px rgba(156, 39, 176, 0.2);
    }

    .navbar-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        color: white;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        border: 2px solid white;
        box-shadow: 0 4px 8px rgba(156, 39, 176, 0.3);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* Mobile Menu Toggle */
    .navbar-toggle {
        display: none;
        background: white;
        border: 2px solid var(--light-border);
        border-radius: 8px;
        padding: 8px 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1.2rem;
        color: var(--dark);
    }

    .navbar-toggle:hover {
        background: var(--light-border);
        color: var(--accent);
    }

    /* Button Styles */
    .btn-nav {
        padding: 8px 18px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-nav-primary {
        background: linear-gradient(135deg, var(--primary), var(--accent));
        color: white;
        box-shadow: 0 6px 16px rgba(156, 39, 176, 0.25);
    }

    .btn-nav-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 24px rgba(156, 39, 176, 0.35);
        color: white;
    }

    .btn-nav-secondary {
        background: white;
        color: var(--accent);
        border: 2px solid var(--primary);
    }

    .btn-nav-secondary:hover {
        background: var(--light-border);
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(156, 39, 176, 0.15);
    }

    .btn-nav-outline {
        background: transparent;
        color: var(--accent);
        border: 2px solid var(--primary);
    }

    .btn-nav-outline:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-3px);
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .navbar-search {
            max-width: 250px;
        }

        .navbar-links {
            gap: 0.75rem;
        }

        .navbar-link {
            font-size: 13px;
            padding: 6px 0;
        }

        .navbar-icons {
            gap: 0.75rem;
        }

        .navbar-icon {
            width: 36px;
            height: 36px;
            font-size: 0.9rem;
        }

        .btn-nav {
            padding: 7px 14px;
            font-size: 12px;
        }
    }

    @media (max-width: 768px) {
        .navbar-home {
            padding: 0.75rem 1rem;
        }

        .navbar-home-container {
            gap: 1rem;
        }

        .navbar-search {
            display: none;
        }

        .navbar-links {
            display: none;
        }

        .navbar-toggle {
            display: flex;
        }

        .navbar-brand-home {
            font-size: 1.3rem;
        }

        .navbar-brand-home i {
            font-size: 1.5rem;
        }
    }

    /* Add body padding to account for fixed navbar */
    body {
        padding-top: 70px;
    }
</style>

@php
    $notificationCount = auth()->check()
        ? \App\Models\StoreNotification::where('user_id', auth()->id())->where('is_read', false)->count()
        : 0;
    $cartCount = auth()->check()
        ? \App\Models\Cart::where('user_id', auth()->id())->sum('quantity')
        : 0;
@endphp

<!-- Enhanced Sticky Navbar -->
<nav class="navbar-home" id="navbarHome">
    <div class="navbar-home-container">
        <!-- Brand -->
        <a href="/" class="navbar-brand-home">
            <i class="fas fa-shopping-bag"></i>
            <span>NextMart</span>
        </a>

        <!-- Search Bar -->
        <div class="navbar-search">
            <input type="text" placeholder="Search products...">
        </div>

        <!-- Navigation Links -->
        <ul class="navbar-links">

            <li><a href="/" class="navbar-link {{ url()->current() === url('/') ? 'active' : '' }}">Home</a></li>
            <li><a href="/products" class="navbar-link {{ request()->is('products') || request()->is('products/*') ? 'active' : '' }}">Products</a></li>
            <li><a href="/about" class="navbar-link {{ url()->current() === url('/about') ? 'active' : '' }}">About</a></li>
            <li><a href="#contact" class="navbar-link">Contact</a></li>

        </ul>

        <!-- Navbar Icons -->
        <div class="navbar-icons">
            <!-- Notifications -->
            <a href="/notifications" class="navbar-icon" title="Order Updates">
                <i class="fas fa-bell"></i>
                @if($notificationCount > 0)
                    <span class="navbar-badge">{{ $notificationCount }}</span>
                @endif
            </a>

            <!-- Cart -->
            <a href="/cart" class="navbar-icon" title="Shopping Cart">
                <i class="fas fa-shopping-cart"></i>
                @if($cartCount > 0)
                    <span class="navbar-badge">{{ $cartCount }}</span>
                @endif
            </a>

            <!-- User -->
            @auth
                <a href="{{ route('profile.edit') }}" class="navbar-icon" title="My Profile" style="padding: 0;">
                    <div class="navbar-profile-visual">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}">
                        @else
                            <i class="fas fa-user"></i>
                        @endif
                    </div>
                </a>
            @else
                <a href="{{ route('register') }}" class="navbar-icon" title="Create Account" style="padding: 0;">
                    <div class="navbar-profile-visual">
                        <i class="fas fa-user"></i>
                    </div>
                </a>
            @endauth

            <!-- Mobile Menu Toggle -->
            <button class="navbar-toggle" id="navbarToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</nav>

<script>
    // Sticky navbar scroll effect
    const navbar = document.getElementById('navbarHome');
    let lastScrollTop = 0;

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        
        lastScrollTop = scrollTop;
    });

    // Smooth scroll for navigation links
    document.querySelectorAll('.navbar-link').forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href.startsWith('#')) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    
                    // Update active link
                    document.querySelectorAll('.navbar-link').forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                }
            }
        });
    });

    // Mobile menu toggle
    const navbarToggle = document.getElementById('navbarToggle');
    navbarToggle.addEventListener('click', function() {
        // Add mobile menu functionality here
        alert('Mobile menu - coming soon!');
    });
</script>
