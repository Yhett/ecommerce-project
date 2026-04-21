<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: white; border: 2px solid #e1bee7; border-radius: 20px; color: #333;">
            <div class="modal-header border-0 pb-0">
                <div class="w-100">
                    <h5 class="modal-title fw-bold d-flex align-items-center" id="loginModalLabel" style="color: #6a1b9a;">
                        <i class="fas fa-sign-in-alt me-2" style="color: #9c27b0;"></i> Welcome Back
                    </h5>
                    <p class="text-secondary small mb-0">Sign in to your account</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-600 small" style="color: #555;">
                            <i class="fas fa-envelope me-1" style="color: #9c27b0;"></i> Email Address
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" 
                               placeholder="Enter your email" required
                               style="background: #f8f8f8; border: 1.5px solid #e1bee7; border-radius: 12px; color: #333;">
                        @error('email')
                            <div class="text-danger small mt-1">⚠ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-600 small" style="color: #555;">
                            <i class="fas fa-lock me-1" style="color: #9c27b0;"></i> Password
                        </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" 
                               placeholder="Enter your password" required
                               style="background: #f8f8f8; border: 1.5px solid #e1bee7; border-radius: 12px; color: #333;">
                        @error('password')
                            <div class="text-danger small mt-1">⚠ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" style="background: white; border: 1px solid #ddd;">
                        <label class="form-check-label small" style="color: #666;" for="remember">
                            Remember me
                        </label>
                    </div>

                    <button type="submit" class="btn w-100" 
                            style="background: linear-gradient(135deg, #ba68c8, #ab47bc); color: white; border: none; border-radius: 12px; font-weight: 700; padding: 10px; transition: all 0.3s ease;"
                            onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 30px rgba(156, 39, 176, 0.3)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 20px rgba(156, 39, 176, 0.2)'">
                        <i class="fas fa-sign-in-alt me-2"></i> Sign In
                    </button>
                </form>

                <div class="text-center my-3">
                    <small style="color: #666;">
                        <span>Don't have an account?</span>
                        <a href="#" onclick="document.getElementById('loginModal').style.display='none'; new bootstrap.Modal(document.getElementById('registerModal')).show();" style="text-decoration: none; color: #9c27b0 !important; font-weight: 600;">
                            Create one
                        </a>
                    </small>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-center">
                        <small>
                            <a href="{{ route('password.request') }}" style="text-decoration: none; color: #9c27b0;">Forgot password?</a>
                        </small>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: white; border: 2px solid #e1bee7; border-radius: 20px; color: #333;">
            <div class="modal-header border-0 pb-0">
                <div class="w-100">
                    <h5 class="modal-title fw-bold d-flex align-items-center" id="registerModalLabel" style="color: #6a1b9a;">
                        <i class="fas fa-user-plus me-2" style="color: #9c27b0;"></i> Create Account
                    </h5>
                    <p class="text-secondary small mb-0">Join NextMart today</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-600 small" style="color: #555;">
                            <i class="fas fa-user me-1" style="color: #9c27b0;"></i> Full Name
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" 
                               placeholder="Enter your full name" required
                               style="background: #f8f8f8; border: 1.5px solid #e1bee7; border-radius: 12px; color: #333;">
                        @error('name')
                            <div class="text-danger small mt-1">⚠ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="register_email" class="form-label fw-600 small" style="color: #555;">
                            <i class="fas fa-envelope me-1" style="color: #9c27b0;"></i> Email Address
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="register_email" name="email" value="{{ old('email') }}" 
                               placeholder="Enter your email" required
                               style="background: #f8f8f8; border: 1.5px solid #e1bee7; border-radius: 12px; color: #333;">
                        @error('email')
                            <div class="text-danger small mt-1">⚠ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="register_password" class="form-label fw-600 small" style="color: #555;">
                            <i class="fas fa-lock me-1" style="color: #9c27b0;"></i> Password
                        </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="register_password" name="password" 
                               placeholder="Create a strong password" required
                               style="background: #f8f8f8; border: 1.5px solid #e1bee7; border-radius: 12px; color: #333;">
                        @error('password')
                            <div class="text-danger small mt-1">⚠ {{ $message }}</div>
                        @enderror
                        <ul class="list-unstyled small mt-2 ps-3" style="color: #666;">
                            <li><i class="fas fa-check-circle me-1" style="color: #9c27b0;"></i> At least 8 characters</li>
                            <li><i class="fas fa-check-circle me-1" style="color: #9c27b0;"></i> Mix of upper & lowercase</li>
                            <li><i class="fas fa-check-circle me-1" style="color: #9c27b0;"></i> Include numbers & symbols</li>
                        </ul>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-600 small" style="color: #555;">
                            <i class="fas fa-check-circle me-1" style="color: #9c27b0;"></i> Confirm Password
                        </label>
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation" 
                               placeholder="Confirm your password" required
                               style="background: #f8f8f8; border: 1.5px solid #e1bee7; border-radius: 12px; color: #333;">
                    </div>

                    <button type="submit" class="btn w-100" 
                            style="background: linear-gradient(135deg, #ba68c8, #ab47bc); color: white; border: none; border-radius: 12px; font-weight: 700; padding: 10px; transition: all 0.3s ease; margin-top: 10px;"
                            onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 30px rgba(156, 39, 176, 0.3)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 20px rgba(156, 39, 176, 0.2)'">
                        <i class="fas fa-user-plus me-2"></i> Create Account
                    </button>
                </form>

                <div class="text-center mt-3">
                    <small style="color: #666;">
                        <span>Already have an account?</span>
                        <a href="#" onclick="document.getElementById('registerModal').style.display='none'; new bootstrap.Modal(document.getElementById('loginModal')).show();" style="text-decoration: none; color: #9c27b0 !important; font-weight: 600;">
                            Sign in
                        </a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control::placeholder {
        color: #999 !important;
    }

    .form-control:focus {
        background: white !important;
        border-color: #9c27b0 !important;
        box-shadow: 0 0 0 3px rgba(156, 39, 176, 0.1) !important;
        color: #333 !important;
    }

    .modal-content {
        color: #333;
    }

    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
    }

    .text-secondary {
        color: #999 !important;
    }

    @media (max-width: 576px) {
        .modal-dialog {
            margin: 1rem;
        }
    }
</style>
