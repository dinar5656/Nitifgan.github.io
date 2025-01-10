@extends('layouts.app')

@section('content')
<div class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-cover">
            <div class="profile-avatar">
                <img src="{{ asset('storage/' . $profile->photo) }}" alt="User Avatar">
                <button class="edit-avatar"><i class="fas fa-camera"></i></button>
            </div>
        </div>
        <div class="profile-info">
            <h1>{{ $profile->username ?? 'User Name' }}</h1>
            <p>{{ $profile->email ?? 'user@example.com' }}</p>
            <div class="d-flex justify-content-start mt-4">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary me-2">Edit Profile</a>
            </div>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="profile-content">
        <div class="profile-nav">
            <a href="#personal" class="active">Personal Info</a>
            <a href="#orders">Orders</a>
            <a href="#wishlist">Wishlist</a>
            <a href="#settings">Settings</a>
        </div>

        <div class="profile-sections">
            <!-- Personal Info Section -->
            <div class="profile-section" id="personal-info">
                <h2>Personal Information</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Address</label>
                        <p>{{ $profile->address ?? 'N/A' }}</p>
                    </div>
                    <div class="info-item">
                        <label>Phone Number</label>
                        <p>{{ $profile->phone ?? 'N/A' }}</p>
                    </div>
                    <div class="info-item">
                        <label>Bio</label>
                        <p>{{ $profile->bio ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="profile-section">
                <h2>Recent Orders</h2>
                <div class="orders-list">
                    <div class="order-item">
                        <div class="order-info">
                            <span class="order-id">Orders</span>
                            <span class="order-date">{{ $orderCount ?? 0 }}</span>
                        </div>
                        <div class="order-status">
                            <span class="status delivered">Wishlist Items</span>
                            <span class="order-price">{{ $wishlistCount }}</span>
                        </div>
                        <div class="order-status">
                            <span class="status delivered">Total Spend</span>
                            <span class="order-price">${{ $totalPrice }}</span>
                        </div>
                    </div>
                    <!-- More order items -->
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Inter', sans-serif;
}

.profile-header {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    overflow: hidden;
    margin-bottom: 30px;
}

.profile-cover {
    height: 200px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    position: relative;
}

.profile-avatar {
    position: absolute;
    bottom: -50px;
    left: 50px;
}

.profile-avatar img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 5px solid white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.edit-avatar {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 50%;
    width: 36px;
    height: 36px;
    cursor: pointer;
}

.profile-info {
    padding: 60px 50px 30px;
}

.profile-info h1 {
    margin: 0;
    font-size: 24px;
    color: #333;
}

.profile-info p {
    color: #666;
    margin: 5px 0 15px;
}

.edit-profile-btn {
    background: #007bff;
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s;
}

.edit-profile-btn:hover {
    background: #0056b3;
}

.profile-nav {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
}

.profile-nav a {
    color: #666;
    text-decoration: none;
    padding: 10px 0;
    position: relative;
}

.profile-nav a.active {
    color: #007bff;
}

.profile-nav a.active::after {
    content: '';
    position: absolute;
    bottom: -11px;
    left: 0;
    width: 100%;
    height: 2px;
    background: #007bff;
}

.profile-section {
    background: white;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.profile-section h2 {
    margin: 0 0 20px;
    font-size: 20px;
    color: #333;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}

.info-item label {
    display: block;
    color: #666;
    margin-bottom: 5px;
    font-size: 14px;
}

.info-item p {
    margin: 0;
    color: #333;
    font-size: 16px;
}

.orders-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.order-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    border: 1px solid #eee;
    border-radius: 8px;
}

.order-info {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.order-id {
    font-weight: 600;
    color: #333;
}

.order-date {
    color: #666;
    font-size: 14px;
}

.order-status {
    text-align: right;
}

.status {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 14px;
    margin-bottom: 5px;
}

.status.delivered {
    background: #e8f5e9;
    color: #2e7d32;
}

.order-price {
    display: block;
    color: #333;
    font-weight: 600;
}

@media (max-width: 768px) {
    .info-grid {
        grid-template-columns: 1fr;
    }

    .profile-nav {
        overflow-x: auto;
        padding-bottom: 5px;
    }

    .profile-avatar {
        left: 50%;
        transform: translateX(-50%);
    }

    .profile-info {
        text-align: center;
        padding-top: 70px;
    }
}
</style>
@endsection
