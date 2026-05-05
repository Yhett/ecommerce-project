@extends('layout')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .contact-hero {
            background: linear-gradient(135deg, #493483 0%, #764ba2 100%);
        }
        .form-floating {
            position: relative;
        }
        .form-floating input, .form-floating textarea {
            border-radius: 12px;
            border: 1px solid #e1e5e9;
            padding: 1rem 1rem 0.5rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-floating input:focus, .form-floating textarea:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 0.2rem rgba(118, 75, 162, 0.25);
        }
        .form-floating label {
            padding-left: 1rem;
            color: #6c757d;
        }
        .contact-info-card {
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .contact-info-card:hover {
            transform: translateY(-5px);
        }
        .map-section {
            height: 400px;
            width: 100%;
        }
        .success-alert-card {
            animation: slideDown 0.5s ease-out;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .btn-loading {
            pointer-events: none;
            opacity: 0.7;
        }
    </style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="contact-hero py-5 text-white text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto animate__animated animate__fadeInDown">
                <h1 class="display-3 fw-bold mb-4">Contact Us</h1>
                <p class="lead mb-5" style="font-size: 1.4rem;">
                    We'd love to hear from you. Send us a message and we'll respond as soon as possible.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="text-center contact-info-card p-5 rounded-4 h-100 animate__animated animate__fadeInUp animate__delay-1s">
                    <i class="fa-solid fa-location-dot fa-3x text-primary mb-4"></i>
                    <h4 class="h3 fw-bold mb-3">Visit Us</h4>
                    <p class="lead text-muted mb-0">Tomas Cabiles St.<br>Tabaco City, Albay<br>Philippines</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="text-center contact-info-card p-5 rounded-4 h-100 animate__animated animate__fadeInUp animate__delay-2s">
                    <i class="fa-solid fa-phone fa-3x text-success mb-4"></i>
                    <h4 class="h3 fw-bold mb-3">Call Us</h4>
                    <p class="lead text-muted mb-2">+63 917 123 4567</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="text-center contact-info-card p-5 rounded-4 h-100 animate__animated animate__fadeInUp animate__delay-3s">
                    <i class="fa-solid fa-envelope fa-3x text-danger mb-4"></i>
                    <h4 class="h3 fw-bold mb-3">Email Us</h4>
                    <p class="lead text-muted mb-0">nextmart@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Location Map -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="map-section rounded-4 overflow-hidden shadow-lg animate__animated animate__fadeInUp animate__delay-4s">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d333.34549958342745!2d123.72805342136878!3d13.357521094788497!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sph!4v1776859605148!5m2!1sen!2sph" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Social Media -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5 animate__animated animate__fadeInUp">
            <h3 class="h2 fw-bold mb-4" style="color: #2f2340;">Follow Us</h3>
            <p class="lead text-muted">Connect with us on social media</p>
        </div>
        <div class="row justify-content-center g-4">
            <div class="col-md-2 col-sm-4">
                <a href="#" class="btn btn-outline-primary btn-lg w-100 py-3 rounded-4 shadow-sm hover-lift">
                    <i class="fab fa-facebook-f fa-2x mb-2 d-block"></i>
                    <span>Facebook</span>
                </a>
            </div>
            <div class="col-md-2 col-sm-4">
                <a href="#" class="btn btn-outline-info btn-lg w-100 py-3 rounded-4 shadow-sm hover-lift">
                    <i class="fab fa-x-twitter fa-2x mb-2 d-block"></i>
                    <span>Twitter</span>
                </a>
            </div>
            <div class="col-md-2 col-sm-4">
                <a href="#" class="btn btn-outline-danger btn-lg w-100 py-3 rounded-4 shadow-sm hover-lift">
                    <i class="fab fa-instagram fa-2x mb-2 d-block"></i>
                    <span>Instagram</span>
                </a>
            </div>
            <div class="col-md-2 col-sm-4">
                <a href="#" class="btn btn-outline-success btn-lg w-100 py-3 rounded-4 shadow-sm hover-lift">
                    <i class="fab fa-whatsapp fa-2x mb-2 d-block"></i>
                    <span>WhatsApp</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form -->
<section class="py-5" id="contact-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show success-alert-card mb-4" role="alert">
                        <i class="fa-solid fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-5 fw-bold" style="color: #2f2340;">Send Us a Message</h2>

                        <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                        <label for="name">Full Name</label>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                        <label for="email">Email Address</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}">
                                        <label for="subject">Subject (Optional)</label>
                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" style="height: 150px" required>{{ old('message') }}</textarea>
                                        <label for="message">Your Message</label>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-3 fw-bold shadow-lg" style="border-radius: 50px; font-size: 1.1rem;" id="submitBtn">
                                        <i class="fa-solid fa-paper-plane me-2"></i>Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');

    // Scroll to form if success
    @if (session('success'))
        document.getElementById('contact-form').scrollIntoView({ behavior: 'smooth' });
    @endif

    // Form submission handling
    form.addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();
        
        if (!name || !email || !message) {
            e.preventDefault();
            alert('Please fill in all required fields.');
            return false;
        }
        
        if (!email.includes('@') || !email.includes('.')) {
            e.preventDefault();
            alert('Please enter a valid email address.');
            return false;
        }

        // Loading state
        submitBtn.classList.add('btn-loading');
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i>Sending...';
        submitBtn.disabled = true;
    });
});
</script>
@endpush

@endsection

