<!-- Auth Buttons for Homepage -->
<div class="d-flex gap-3 align-items-center" style="animation: slideUp 0.5s ease-out;">
    <!-- Login Button -->
    <button class="btn" style="background: linear-gradient(135deg, #ba68c8, #ab47bc); color: white; border: none; border-radius: 12px; padding: 10px 24px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 8px 20px rgba(156, 39, 176, 0.2);"
            data-bs-toggle="modal" data-bs-target="#loginModal"
            onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 30px rgba(156, 39, 176, 0.3)'"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 20px rgba(156, 39, 176, 0.2)'">
        <i class="fas fa-sign-in-alt me-2"></i> Sign In
    </button>

    <!-- Register Button -->
    <button class="btn" style="background: rgba(186, 104, 200, 0.15); color: #9c27b0; border: 2px solid #ba68c8; border-radius: 12px; padding: 8px 22px; font-weight: 600; transition: all 0.3s ease;"
            data-bs-toggle="modal" data-bs-target="#registerModal"
            onmouseover="this.style.background='rgba(186, 104, 200, 0.25)'; this.style.transform='translateY(-3px)'"
            onmouseout="this.style.background='rgba(186, 104, 200, 0.15)'; this.style.transform='translateY(0)'">
        <i class="fas fa-user-plus me-2"></i> Register
    </button>
</div>

<style>
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
