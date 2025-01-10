<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('deskapp/vendors/images/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('deskapp/vendors/images/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('deskapp/vendors/images/favicon-16x16.png') }}" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/vendors/styles/style.css') }}" />
</head>
<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="{{ route('login') }}">
                    <img src="{{ asset('deskapp/vendors/images/deskapp-logo.svg') }}" alt="Logo" />
                </a>
            </div>
        </div>
    </div>
    
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="{{ asset('deskapp/vendors/images/login-page-img.png') }}" alt="Login Page Image" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Sign In or Create Account</h2>
                        </div>
                        
                        <!-- Form Login -->
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <!-- Pilihan Role (Admin / User) -->
                            <div class="select-role">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn active">
                                        <input type="radio" name="options" id="admin" />
                                        <div class="icon">
                                            <img src="{{ asset('deskapp/vendors/images/briefcase.svg') }}" class="svg" alt="" />
                                        </div>
                                        <span>I'm</span>
                                        Manager
                                    </label>
                                    <label class="btn">
                                        <input type="radio" name="options" id="user" />
                                        <div class="icon">
                                            <img src="{{ asset('deskapp/vendors/images/person.svg') }}" class="svg" alt="" />
                                        </div>
                                        <span>I'm</span>
                                        Employee
                                    </label>
                                </div>
                            </div>

                            <!-- Input untuk Username -->
                            <div class="input-group custom">
                                <input type="text" name="email" class="form-control form-control-lg" placeholder="Username" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text">
                                        <i class="icon-copy dw dw-user1"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Input untuk Password -->
                            <div class="input-group custom">
                                <input type="password" name="password" class="form-control form-control-lg" placeholder="**********" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text">
                                        <i class="dw dw-padlock1"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Pilihan untuk "Remember Me" dan link "Forgot Password" -->
                            <div class="row pb-30">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" />
                                        <label class="custom-control-label" for="customCheck1">Remember</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="forgot-password">
                                        <a href="{{ route('password.request') }}">Forgot Password</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Login dan bagian untuk switch ke registrasi -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Sign In</button>
                                    </div>
                                    <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">
                                        OR
                                    </div>
                                    <!-- Tombol untuk membuka form registrasi -->
                                    <div class="input-group mb-0">
                                        <a class="btn btn-outline-primary btn-lg btn-block" href="#" id="createAccountBtn">Create Account</a>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Form Registrasi yang tersembunyi -->
                        <!-- Form ini akan muncul setelah klik tombol "Create Account" -->
                        <form action="{{ route('register') }}" method="POST" style="display: none;" id="registerForm">
                            @csrf
                            <!-- Input untuk nama lengkap pada form registrasi -->
                            <div class="input-group custom">
                                <input type="text" name="name" class="form-control form-control-lg" placeholder="Full Name" required />
                                <div class="input-group-append custom">
                                    <span class="input-group-text">
                                        <i class="icon-copy dw dw-user1"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Input untuk email pada form registrasi -->
                            <div class="input-group custom">
                                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required />
                                <div class="input-group-append custom">
                                    <span class="input-group-text">
                                        <i class="icon-copy dw dw-envelope"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Input untuk password pada form registrasi -->
                            <div class="input-group custom">
                                <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required />
                                <div class="input-group-append custom">
                                    <span class="input-group-text">
                                        <i class="dw dw-padlock1"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Input untuk konfirmasi password pada form registrasi -->
                            <div class="input-group custom">
                                <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="Confirm Password" required />
                                <div class="input-group-append custom">
                                    <span class="input-group-text">
                                        <i class="dw dw-padlock1"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Tombol untuk mengirimkan data registrasi -->
                            <div class="input-group mb-0">
                                <button type="submit" class="btn btn-success btn-lg btn-block">Create Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('deskapp/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('deskapp/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('deskapp/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('deskapp/vendors/scripts/layout-settings.js') }}"></script>

    <!-- Script untuk beralih antara form Login dan Registrasi -->
    <script>
        // Switch antara form Login dan Registrasi
        // Ketika tombol "Create Account" diklik, form login disembunyikan dan form registrasi ditampilkan
        document.getElementById('createAccountBtn').addEventListener('click', function(e) {
            e.preventDefault();
            // Menyembunyikan form login
            document.querySelector('form[action="{{ route('login') }}"]').style.display = 'none';
            // Menampilkan form registrasi
            document.getElementById('registerForm').style.display = 'block';
        });
    </script>
</body>
</html>
