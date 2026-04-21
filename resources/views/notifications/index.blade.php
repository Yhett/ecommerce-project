@extends('layout')

@section('content')
<style>
    .notifications-page {
        padding-bottom: 2rem;
    }

    .notifications-hero {
        background: linear-gradient(135deg, #f7e8fb 0%, #ffffff 100%);
        border: 1px solid #edd8f4;
        border-radius: 24px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 18px 40px rgba(156, 39, 176, 0.08);
    }

    .notifications-hero h1 {
        color: #6a1b9a;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .notifications-hero p {
        color: #6c757d;
        margin-bottom: 0;
    }

    .notification-card {
        background: white;
        border: 1px solid #edd8f4;
        border-radius: 20px;
        padding: 1.25rem;
        box-shadow: 0 10px 24px rgba(156, 39, 176, 0.08);
        display: flex;
        gap: 1rem;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .notification-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ba68c8, #9c27b0);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 1.1rem;
    }

    .notification-card h5 {
        margin-bottom: 0.35rem;
        color: #2f2340;
    }

    .notification-card p {
        margin-bottom: 0.35rem;
        color: #6c757d;
    }

    .notification-time {
        font-size: 0.9rem;
        color: #9c27b0;
        font-weight: 600;
    }

    .empty-notifications {
        text-align: center;
        padding: 3rem 1.5rem;
        background: white;
        border: 1px solid #edd8f4;
        border-radius: 20px;
        box-shadow: 0 10px 24px rgba(156, 39, 176, 0.08);
    }
</style>

<div class="notifications-page">
    <section class="notifications-hero">
        <h1>Notifications</h1>
        <p>Stay updated with your order activity and recent account-related store updates.</p>
    </section>

    @forelse($notifications as $notification)
        <div class="notification-card">
            <div class="notification-icon">
                <i class="fa-solid {{ $notification->type === 'order_status' ? 'fa-truck-fast' : ($notification->type === 'order_placed' ? 'fa-box' : 'fa-bell') }}"></i>
            </div>
            <div>
                <h5>{{ $notification->title }}</h5>
                <p>{{ $notification->message }}</p>
                <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>
            </div>
        </div>
    @empty
        <div class="empty-notifications">
            <h4 class="mb-2">No notifications yet</h4>
            <p class="text-muted mb-0">Your order updates and store messages will appear here.</p>
        </div>
    @endforelse
</div>
@endsection
