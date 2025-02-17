<!DOCTYPE html>
<html lang="en">

<!-- auth-login.html  Tue, 07 Jan 2020 03:39:47 GMT -->
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Ecommerce Dashboard &mdash; CodiePie</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ url('admin/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/assets/modules/fontawesome/css/all.min.css') }}">

    {{-- Icon CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ url('admin/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ url('admin/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ url('admin/assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/assets/css/components.min.css') }}">
</head>

<body class="layout-4">

    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="{{ asset('images/logo.png') }}" alt="logo" width="100">
                        </div>
                        <div class="card card-primary">
                            {{-- <div class="card-header">
                    <h4>Login</h4>
                </div> --}}
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                                    @csrf
                                    <div class="form-group">

                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" tabindex="1" required autofocus autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                            <x-input-label for="password" :value="__('Password')" />

                                            <x-text-input id="password" class="form-control block mt-1 w-full" type="password" name="password" tabindex="2" required autocomplete="current-password" />
                                        </div>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        {{-- <div class="invalid-feedback">
                            </div> --}}
                                    </div>

                                    <!-- Remember Me -->
                                    {{-- <div class="form-group block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="custom-control-input" name="remember" tabindex="3" id="remember-me">
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                    </label>
                            </div> --}}


                            {{-- <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                <label class="custom-control-label" for="remember-me">Remember Me</label>
                            </div>
                        </div> --}}

                            <div class="form-group flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                                @endif

                                <x-primary-button class="ms-3 btn btn-primary btn-lg btn-block" tabindex="4">
                                    {{ __('Log in') }}
                                </x-primary-button>
                            </div>


                            {{-- <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            Login
                            </button>
                        </div> --}}
                            </form>
                            {{-- <div class="text-center mt-4 mb-3">
                        <div class="text-job text-muted">Login With Social</div>
                    </div> --}}
                            {{-- <div class="row sm-gutters">
                        <div class="col-6">
                            <a class="btn btn-block btn-social btn-facebook"><span class="fab fa-facebook"></span> Facebook</a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-block btn-social btn-twitter"><span class="fab fa-twitter"></span> Twitter</a>
                        </div>
                    </div> --}}
                        </div>
                    </div>
                    <div class="mt-0 text-muted text-center">
                        Don't have an account? <a href="{{ route('register') }}">Create One</a>
                    </div>

                </div>
            </div>

    </div>
    </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ url('admin/assets/bundles/lib.vendor.bundle.js') }}"></script>
    <script src="{{ url('admin/js/CodiePie.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ url('admin/assets/modules/jquery.sparkline.min.js') }}"></script>
    <script src="{{ url('admin/assets/modules/chart.min.js') }}"></script>
    <script src="{{ url('admin/assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ url('admin/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ url('admin/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ url('admin/js/page/index.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ url('admin/js/scripts.js') }}"></script>
    <script src="{{ url('admin/js/custom.js') }}"></script>
</body>

<!-- auth-login.html  Tue, 07 Jan 2020 03:39:47 GMT -->
</html>
{{-- </x-guest-layout> --}}
