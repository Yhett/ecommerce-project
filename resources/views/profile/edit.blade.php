@extends('layout')

@section('content')
<style>
    .profile-page {
        padding-bottom: 2rem;
    }

    .profile-hero {
        background: linear-gradient(135deg, #f7e8fb 0%, #ffffff 100%);
        border: 1px solid #edd8f4;
        border-radius: 28px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 18px 40px rgba(156, 39, 176, 0.08);
    }

    .profile-avatar {
        width: 92px;
        height: 92px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ba68c8, #9c27b0);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 700;
        box-shadow: 0 10px 24px rgba(156, 39, 176, 0.2);
        overflow: hidden;
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-hero h1 {
        color: #6a1b9a;
        font-weight: 700;
        margin-bottom: 0.35rem;
    }

    .profile-hero p,
    .profile-meta {
        color: #6c757d;
    }

    .profile-card {
        background: white;
        border: 1px solid #edd8f4;
        border-radius: 24px;
        padding: 1.5rem;
        box-shadow: 0 10px 24px rgba(156, 39, 176, 0.08);
        height: 100%;
    }

    .profile-card h3 {
        color: #6a1b9a;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.4rem;
    }

    .profile-card p {
        color: #6c757d;
        margin-bottom: 1rem;
    }

    .profile-label {
        font-size: 0.92rem;
        font-weight: 600;
        color: #4b3a57;
        margin-bottom: 0.45rem;
    }

    .profile-input {
        border: 1.5px solid #e6d2ee;
        border-radius: 14px;
        padding: 0.75rem 0.95rem;
        background: #fcf8fd;
    }

    .profile-input:focus {
        border-color: #9c27b0;
        box-shadow: 0 0 0 0.2rem rgba(156, 39, 176, 0.12);
        background: white;
    }

    .profile-btn-primary {
        background: linear-gradient(135deg, #ba68c8, #ab47bc);
        border: none;
        border-radius: 14px;
        color: white;
        font-weight: 700;
        padding: 0.75rem 1.1rem;
    }

    .profile-btn-danger {
        background: #fff5f5;
        border: 1px solid #f3c2c2;
        color: #b42318;
        border-radius: 14px;
        font-weight: 700;
        padding: 0.75rem 1.1rem;
    }

    .profile-btn-logout {
        background: white;
        border: 1px solid #d9c4e4;
        color: #6a1b9a;
        border-radius: 14px;
        font-weight: 700;
        padding: 0.75rem 1.1rem;
    }

    .profile-status {
        color: #9c27b0;
        font-weight: 600;
        font-size: 0.92rem;
    }

    .profile-photo-upload {
        border: 1.5px dashed #d9c4e4;
        border-radius: 18px;
        padding: 1rem;
        background: #fcf8fd;
    }
</style>

<div class="profile-page">
    <section class="profile-hero">
        <div class="d-flex flex-column flex-md-row align-items-md-center gap-4">
            <div class="profile-avatar">
                @if($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}">
                @else
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                @endif
            </div>
            <div>
                <h1>{{ $user->name }}</h1>
                <p class="mb-2">{{ $user->email }}</p>
                <div class="profile-meta">Member account settings and security controls.</div>
            </div>
        </div>
    </section>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="profile-card">
                <h3>Account Overview</h3>
                <p>Quick details about your account in NextMart.</p>

                <div class="mb-3">
                    <div class="profile-label">Full Name</div>
                    <div>{{ $user->name }}</div>
                </div>

                <div class="mb-3">
                    <div class="profile-label">Email Address</div>
                    <div>{{ $user->email }}</div>
                </div>

                <div class="mb-3">
                    <div class="profile-label">Joined</div>
                    <div>{{ optional($user->created_at)->format('F d, Y') }}</div>
                </div>

                <div>
                    <div class="profile-label">Status</div>
                    <div class="profile-status">Active account</div>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="btn profile-btn-logout w-100">Log Out</button>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="row g-4">
                <div class="col-12">
                    <div class="profile-card">
                        <h3>Profile Information</h3>
                        <p>Update your account details here.</p>

                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label for="profile_photo" class="profile-label">Profile Picture</label>
                                <div class="profile-photo-upload">
                                    <input id="profile_photo" name="profile_photo" type="file" class="form-control profile-input @error('profile_photo') is-invalid @enderror" accept="image/*">
                                    <div class="small text-muted mt-2">Upload a JPG, PNG, or other image up to 2MB.</div>
                                </div>
                                @error('profile_photo')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="name" class="profile-label">Name</label>
                                <input id="name" name="name" type="text" class="form-control profile-input @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="profile-label">Email</label>
                                <input id="email" name="email" type="email" class="form-control profile-input @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn profile-btn-primary">Save Changes</button>

                            @if (session('status') === 'profile-updated')
                                <span class="profile-status ms-3">Profile updated successfully.</span>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="col-12">
                    <div class="profile-card">
                        <h3>Change Password</h3>
                        <p>Keep your account secure with a new password.</p>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="current_password" class="profile-label">Current Password</label>
                                <input id="current_password" name="current_password" type="password" class="form-control profile-input @error('current_password', 'updatePassword') is-invalid @enderror" required>
                                @error('current_password', 'updatePassword')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="profile-label">New Password</label>
                                <input id="password" name="password" type="password" class="form-control profile-input @error('password', 'updatePassword') is-invalid @enderror" required>
                                @error('password', 'updatePassword')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="profile-label">Confirm New Password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control profile-input" required>
                            </div>

                            <button type="submit" class="btn profile-btn-primary">Update Password</button>

                            @if (session('status') === 'password-updated')
                                <span class="profile-status ms-3">Password updated successfully.</span>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="col-12">
                    <div class="profile-card">
                        <h3>Delete Account</h3>
                        <p>If you no longer want to use your account, you can permanently remove it here.</p>

                        <form method="POST" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('DELETE')

                            <div class="mb-3">
                                <label for="delete_password" class="profile-label">Confirm Password</label>
                                <input id="delete_password" name="password" type="password" class="form-control profile-input @error('password', 'userDeletion') is-invalid @enderror" required>
                                @error('password', 'userDeletion')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn profile-btn-danger">Delete Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
