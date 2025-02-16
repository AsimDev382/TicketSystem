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
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
                <img src="{{ asset('images/logo.png') }}" alt="logo" width="100">
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Register</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="form-group">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                        </div>



                        <div class="form-group">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                        </div>


                        <!-- Password -->
                        <div class="form-group">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="form-control pwstrength block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required data-indicator="pwindicator" autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="form-control block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                        </div>


                            <div class="flex items-center justify-end mt-4 form-group">
                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>

                                <x-primary-button class="ms-4 btn btn-primary btn-lg btn-block">
                                    {{ __('Register') }}
                                </x-primary-button>
                            </div>

                        {{-- <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                                <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
                        </div> --}}
                    </form>
                </div>
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
</html>

