<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}"> 
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		
		<title>@yield('title')  {{ $appsetting->website_name ?? 'website_name' }}</title>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">
		
		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="{{ asset('deskapp/vendors/images/apple-touch-icon.png') }}"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="{{ asset('deskapp//images/favicon-32x32.png') }}"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="{{ asset('deskapp/vendors/images/favicon-16x16.png') }}"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="{{ asset('deskapp/vendors/styles/core.css') }}" />
		<link
			rel="stylesheet"
			type="text/css"
			href="{{ asset('deskapp/vendors/styles/icon-font.min.css') }}"
		/>
		<link rel="stylesheet" type="text/css" href="{{ asset('deskapp/vendors/styles/style.css') }}" />

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script
			async
			src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"
		></script>
		<script
			async
			src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
			crossorigin="anonymous"
		></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag() {
				dataLayer.push(arguments);
			}
			gtag("js", new Date());

			gtag("config", "G-GBZ3SGGX85");
		</script>
		<!-- Google Tag Manager -->
		<script>
			(function (w, d, s, l, i) {
				w[l] = w[l] || [];
				w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
				var f = d.getElementsByTagName(s)[0],
					j = d.createElement(s),
					dl = l != "dataLayer" ? "&l=" + l : "";
				j.async = true;
				j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
				f.parentNode.insertBefore(j, f);
			})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
		</script>
		<!-- End Google Tag Manager -->

        @livewireStyles
	</head>
	<body>
    <div class="main-container">
        @include('layouts.inc.admin.navbar')
            <div class="container-fluid page-body-wrapper">
            @include('layouts.inc.admin.sidebar')
            <div class="main-panel">
                <div class="content-wrapper"></div>
                @yield('content')
            </div>
        </div>
    </div>
</div>
		<div class="pre-loader">
			<div class="pre-loader-box">
				<div class="loader-logo">
					<img src="{{ asset('deskapp/vendors/images/deskapp-logo.png') }}" alt="" />
				</div>
				<div class="loader-progress" id="progress_div">
					<div class="bar" id="bar1"></div>
				</div>
				<div class="percent" id="percent1">0%</div>
				<div class="loading-text">Loading...</div>
			</div>
		</div>

		<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>
				<div
					class="search-toggle-icon bi bi-search"
					data-toggle="header_search"
				></div>
			</div>
			<div class="header-right">
				<div class="dashboard-setting user-notification">
					<div class="dropdown">
						<a
							class="dropdown-toggle no-arrow"
							href="javascript:;"
							data-toggle="right-sidebar"
						>
							<i class="dw dw-settings2"></i>
						</a>
					</div>
				</div>
				<div class="user-info-dropdown">
					<div class="dropdown">
						<a
							class="dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<span class="user-icon">
								<img src="{{ asset('deskapp/vendors/images/photo1.png') }}" alt="" />
							</span>
							<span class="user-name">{{ Auth::user()->name }}</span>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
						>
							<a class="dropdown-item" href="#"
								onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
								<i class="dw dw-logout"></i> Log Out
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
						
						</div>
					</div>
				</div>

		<div class="right-sidebar">
			<div class="sidebar-title">
				<h3 class="weight-600 font-16 text-blue">
					Layout Settings
					<span class="btn-block font-weight-400 font-12"
						>User Interface Settings</span
					>
				</h3>
				<div class="close-sidebar" data-toggle="right-sidebar-close">
					<i class="icon-copy ion-close-round"></i>
				</div>
			</div>
			<div class="right-sidebar-body customscroll">
				<div class="right-sidebar-body-content">
					<h4 class="weight-600 font-18 pb-10">Header Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-dark"
							>Dark</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-white active"
							>White</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-dark active"
							>Dark</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-light"
							>White</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
					<div class="sidebar-radio-group pb-10 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-1"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebaricon-1"
								><i class="fa fa-angle-down"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-2"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-2"
							/>
							<label class="custom-control-label" for="sidebaricon-2"
								><i class="ion-plus-round"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-3"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-3"
							/>
							<label class="custom-control-label" for="sidebaricon-3"
								><i class="fa fa-angle-double-right"></i
							></label>
						</div>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
					<div class="sidebar-radio-group pb-30 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-1"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebariconlist-1"
								><i class="ion-minus-round"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-2"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-2"
							/>
							<label class="custom-control-label" for="sidebariconlist-2"
								><i class="fa fa-circle-o" aria-hidden="true"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-3"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-3"
							/>
							<label class="custom-control-label" for="sidebariconlist-3"
								><i class="dw dw-check"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-4"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-4"
								checked=""
							/>
							<label class="custom-control-label" for="sidebariconlist-4"
								><i class="icon-copy dw dw-next-2"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-5"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-5"
							/>
							<label class="custom-control-label" for="sidebariconlist-5"
								><i class="dw dw-fast-forward-1"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-6"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-6"
							/>
							<label class="custom-control-label" for="sidebariconlist-6"
								><i class="dw dw-next"></i
							></label>
						</div>
					</div>

					<div class="reset-options pt-30 text-center">
						<button class="btn btn-danger" id="reset-settings">
							Reset Settings
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="left-side-bar">
			<div class="brand-logo">
				<a href="{{ route('admin.dashboard') }}">
					<img 
						src="{{ asset('deskapp/vendors/images/deskapp-logo-white.png') }}" 
						alt="" class="dark-logo"
						class="light-logo" 
						height="auto"
						style="margin-top: 30px; margin-left: 10px;"
						/>
					<img
						src="{{ asset('deskapp/vendors/images/deskapp-logo-white.png') }}"
						alt="Logo DeskApp White"
						class="light-logo"
						
						height="auto"
						style="margin-top: 30px; margin-left: 10px;" 
					/>


				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li class="dropdown">
						<li>
						<a href="{{ route('admin.dashboard') }}" class="dropdown-toggle no-arrow" style="margin-top: 10px;">
    					<span class="micon bi bi-speedometer2"></span>
    					<span class="mtext">Dashboard</span>
						</a>

						</li>
						</li>
						<li>
							<a href="{{ route('admin.orders') }}" class="dropdown-toggle no-arrow" style="margin-top: 10px;">
								<span class="micon bi bi-textarea-resize"></span>
								<span class="mtext">Orders</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle" style="margin-top: 10px;">
								<span class="micon bi bi-receipt-cutoff"></span
								><span class="mtext">Category</span>
							</a>
							<ul class="submenu">
							<li><a href="{{ route('admin.category.create') }}">Add Category</a></li> <!-- Tautan untuk menambah kategori -->
							<li><a href="{{ route('admin.category.index') }}">View</a></li>
							</ul>
							</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle" style="margin-top: 10px;">
								<span class="micon bi bi-cart"></span>
								<span class="mtext"> Product </span>
							</a>
							<ul class="submenu">
								<li><a href="{{ url('admin/products/create') }}">Add Product </a></li>
								<li><a href="{{ url('admin/products') }}">View Product</a></li>
							</ul>
						</li>
						<li>
							<a href="{{ route('admin.brands') }}" class="dropdown-toggle no-arrow" style="margin-top: 10px;">
								<span class="micon bi bi-command"></span>
								<span class="mtext">Brand</span>
							</a>
						</li>
						<li>
							<a href="{{ route('admin.colors') }}" class="dropdown-toggle no-arrow" style="margin-top: 10px;">
								<span class="micon bi bi-palette"></span>
								<span class="mtext">Colors</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle" style="margin-top: 10px;">
								<span class="micon bi bi-archive"></span
								><span class="mtext"> Users </span>
							</a>
							<ul class="submenu">
								<li><a href="">create User</a></li>
								<li><a href="">view user</a></li>
							</ul>
						</li>
						<li class="dropdown">
						<a href="{{ route('admin.sliders') }}" class="dropdown-toggle no-arrow" style="margin-top: 10px;">
								<span class="micon bi bi-house"></span>
								<span class="mtext">Home Slider</span>
							</a>
						</li>
						<li class="dropdown">
						<a href="{{ route('admin.settings') }}" class="dropdown-toggle no-arrow" style="margin-top: 10px;">
							<span class="micon bi bi-gear"></span> <!-- Ganti bi-house dengan bi-gear -->
							<span class="mtext">Site Setting</span>
						</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="mobile-menu-overlay"></div>

		<!-- welcome modal end -->
		<!-- js -->
		<script src="{{ asset('deskapp/vendors/scripts/core.js') }}"></script>
		<script src="{{ asset('deskapp/vendors/scripts/script.min.js') }}"></script>
		<script src="{{ asset('deskapp/vendors/scripts/process.js') }}"></script>
		<script src="{{ asset('deskapp/vendors/scripts/layout-settings.js') }}"></script>
		<!-- Google Tag Manager (noscript) -->
		<noscript
			><iframe
				src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
				height="0"
				width="0"
				style="display: none; visibility: hidden"
			></iframe
		></noscript>
		<!-- End Google Tag Manager (noscript) -->
        @yield('scripts')
        @livewireScripts
		@push('scripts')
		@endpush
		@stack('scripts')
	</body>
</html>
