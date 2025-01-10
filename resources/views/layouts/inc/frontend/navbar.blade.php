<div class="main-navbar shadow-sm sticky-top">
        <div class="top-navbar bg-dark">
            <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                    <img
                        src="{{ asset('deskapp/vendors/images/deskapp-logo-nav.png') }}"
                        alt="Logo DeskApp White"
                        class="light-logo"
                        width="119"
                        height="auto"
                    />
                </div>

                <div class="col-md-5 my-auto">
                    <form action="{{ url('/search') }}" method="GET" role="search">
                        <div class="search-input-group">
                            <input 
                                type="search" 
                                name="search" 
                                value="{{ request()->get('search') }}" 
                                placeholder="Search your product" 
                                class="search-control" 
                            />
                            <button class="search-button" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-md-5 my-auto">
                    <ul class="nav-menu">
                        <li class="nav-item">
                            <a class="nav-link cart-link" href="{{ url('cart') }}">
                                <i class="fa fa-shopping-cart"></i> 
                                <span class="cart-text">Cart</span>
                                <span class="cart-count">(<livewire:frontend.cart.cart-count />)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link wishlist-link" href="{{ url('wishlist') }}">
                                <i class="fa fa-heart"></i> 
                                <span class="wishlist-text">Wishlist</span>
                                <span class="wishlist-count">(<livewire:frontend.wishlist-count />)</span>
                            </a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link login-link" href="{{ route('login') }}">
                                        <i class="fa fa-sign-in"></i>
                                        {{ __('Login') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item user-dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i> 
                                    <span class="user-name">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu custom-dropdown" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fa fa-user"></i> Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fa fa-user"></i> Admin Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ url('orders') }}"><i class="fa fa-list"></i> My Orders</a></li>
                                    <li><a class="dropdown-item" href="{{ url('wishlist') }}"><i class="fa fa-heart"></i> My Wishlist</a></li>
                                    <li><a class="dropdown-item" href="{{ url('cart') }}"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                                    <li class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item logout-link" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                           <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <nav class="main-nav navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand mobile-brand d-block d-sm-block d-md-none d-lg-none" href="#">
                Nitig Gan
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav main-menu">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/collections') }}">All Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/new-arrivals') }}">New Arrivals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/featured-products') }}">Featured Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/electronics-products') }}">Electronics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/fashions-products') }}">Fashions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/accessories-products') }}">Accessories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/appliances-products') }}">Appliances</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<style>
/* Top Navbar Styles */
.top-navbar {
    background: #000000;
    padding: 15px 0;
}

/* Logo Styles */
.light-logo {
    transition: transform 0.3s ease;
}

.light-logo:hover {
    transform: scale(1.05);
}

/* Search Bar Styles */
.search-input-group {
    display: flex;
    background: #fff;
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.search-control {
    border: none;
    padding: 12px 20px;
    width: 100%;
    outline: none;
    font-size: 0.95rem;
}

.search-button {
    background:rgb(22, 22, 22);
    border: none;
    padding: 0 25px;
    color: white;
    transition: background-color 0.3s ease;
}

.search-button:hover {
    background: #0056b3;
}

/* Navigation Menu Styles */
.nav-menu {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin: 0;
    padding: 0;
    list-style: none;
}

.nav-item {
    margin: 0 10px;
}

.nav-link {
    color: #fff;
    text-decoration: none;
    padding: 8px 15px;
    border-radius: 20px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 5px;
}

.nav-link:hover {
    background: rgba(255,255,255,0.1);
    color: #fff;
}

/* Cart and Wishlist Styles */
.cart-link, .wishlist-link {
    position: relative;
}

.cart-count, .wishlist-count {
    background: #ff4444;
    color: white;
    padding: 2px 6px;
    border-radius: 10px;
    font-size: 0.8rem;
}

/* User Dropdown Styles */
.custom-dropdown {
    background: #222222;
    border: none;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.2);
}

.custom-dropdown .dropdown-item {
    padding: 10px 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: background 0.3s ease;
    color: #ffffff;
}

.custom-dropdown .dropdown-item:hover {
    background: #333333;
    color: #007bff;
}

.dropdown-divider {
    margin: 8px 0;
    border-top: 1px solid #333333;
}

/* Main Navigation Styles */
.main-nav {
    background: #111111;
    padding: 0;
    box-shadow: 0 2px 5px rgba(0,0,0,0.15);
}

.main-menu {
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 0 20px;
}

.main-menu .nav-link {
    color: #ffffff;
    font-weight: 500;
    padding: 15px 20px;
    border-radius: 0;
    position: relative;
}

.main-menu .nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: #007bff;
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.main-menu .nav-link:hover::after {
    width: 100%;
}

.main-menu .nav-link.active {
    color: #007bff;
}

/* Mobile Brand */
.navbar-brand.mobile-brand {
    color: #ffffff;
}

/* Navbar Toggler */
.navbar-toggler {
    border-color: rgba(255,255,255,0.1);
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.7%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

/* Mobile Responsive Styles */
@media (max-width: 991px) {
    .main-menu {
        padding: 10px;
        flex-direction: column;
    }

    .nav-menu {
        justify-content: center;
        margin-top: 10px;
    }

    .search-input-group {
        margin: 10px 0;
    }
}
</style>