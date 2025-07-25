<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center" style="background:linear-gradient(135deg,#e3f0ff 60%,#4e73df 100%);">
                                <!-- Animated SVG -->
                                <div style="width:100%;max-width:340px;">
                                    <svg viewBox="0 0 340 340" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:auto;">
                                        <defs>
                                            <linearGradient id="grad1" x1="0" y1="0" x2="340" y2="340" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#b3d1ff"/>
                                                <stop offset="0.7" stop-color="#4e73df"/>
                                                <stop offset="1" stop-color="#29469a"/>
                                            </linearGradient>
                                            <linearGradient id="grad2" x1="0" y1="340" x2="340" y2="0" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#e3f0ff"/>
                                                <stop offset="1" stop-color="#b3d1ff"/>
                                            </linearGradient>
                                        </defs>
                                        <circle cx="170" cy="170" r="120" fill="url(#grad1)">
                                            <animate attributeName="r" values="120;130;120" dur="2.5s" repeatCount="indefinite"/>
                                        </circle>
                                        <ellipse cx="170" cy="170" rx="80" ry="110" fill="url(#grad2)" opacity="0.25">
                                            <animate attributeName="rx" values="80;100;80" dur="2.5s" repeatCount="indefinite"/>
                                        </ellipse>
                                        <circle cx="110" cy="110" r="18" fill="#cfe2ff" opacity="0.7">
                                            <animate attributeName="cy" values="110;130;110" dur="2.2s" repeatCount="indefinite"/>
                                        </circle>
                                        <circle cx="230" cy="230" r="14" fill="#cfe2ff" opacity="0.7">
                                            <animate attributeName="cx" values="230;210;230" dur="2.2s" repeatCount="indefinite"/>
                                        </circle>
                                        <text x="50%" y="54%" text-anchor="middle" fill="#29469a" font-size="2.1rem" font-family="Nunito,Arial,sans-serif" font-weight="bold" opacity="0.8">SnackMood</text>
                                        <text x="50%" y="62%" text-anchor="middle" fill="#4e73df" font-size="1.1rem" font-family="Nunito,Arial,sans-serif" opacity="0.7">Login</text>
                                        <text x="50%" y="62%" text-anchor="middle" fill="#29469a" font-size="1.1rem" font-family="Nunito,Arial,sans-serif" opacity="0.7">Login</text>
                                    </svg>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" name="email"
                                                value="{{ old('email') }}" required autofocus
                                                placeholder="Enter Email Address...">
                                            @error('email')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" name="password" required
                                                placeholder="Password">
                                            @error('password')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck"
                                                    name="remember">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <div class="text-center mb-3">
                                            <a href="{{ route('guest.dashboard') }}" class="btn btn-outline-secondary btn-user btn-block"
                                                style="font-size: 13px;">Continue as Guest</a>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <br>
                                    <div class="text-center">
                                        @if (Route::has('password.request'))
                                            <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        @if (Route::has('register'))
                                            <a class="small" href="{{ route('register') }}">Create an Account!</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>