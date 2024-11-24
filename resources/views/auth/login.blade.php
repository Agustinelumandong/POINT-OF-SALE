<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
        content="A fully featured admin theme which can be used to build CRM, CMS, etc."
        name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/pos-logo.png') }}" />

    <!-- Bootstrap css -->
    <link
        href="{{ asset('backend/assets/css/bootstrap.min.css') }}"
        rel="stylesheet"
        type="text/css" />
    <!-- App css -->
    <link
        href="{{ asset('backend/assets/css/app.min.css') }}"
        rel="stylesheet"
        type="text/css"
        id="app-style" />
    <!-- icons -->
    <link
        href="{{ asset('backend/assets/css/icons.min.css') }}"
        rel="stylesheet"
        type="text/css" />

    <!-- LOGIN CSS -->
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('backend/assets/css/login.css') }}" />

    <!-- Head js -->
    <script src="{{ asset('backend/assets/js/head.js') }}"></script>

    <!-- toastr css -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

</head>

<body class="authentication-bg authentication-bg-pattern ">
    <div class="account-pages mt-5 mb-5 pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card rounded-3">
                        <div class="card-body p-4">
                            <div class="text-center w-75 m-auto">
                                <div class="auth-logo ">
                                    <a
                                        href="index.html"
                                        class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img
                                                src="{{ asset('backend/assets/images/pos-logo.png') }}"
                                                alt=""
                                                height="150" />
                                        </span>
                                    </a>

                                    <a
                                        href="index.html"
                                        class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img
                                                src="{{ asset('backend/assets/images/pos-logo.png') }}"
                                                alt=""
                                                height="150" />
                                        </span>
                                    </a>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('login') }}" novalidate class="mt-4">
                                @csrf

                                <div class="mb-2 form-group">
                                    <label
                                        for="login" class="form-label">Username/Email/Phone</label>
                                    <input
                                        class="form-control rounded-pill p-2"
                                        type="text"
                                        id="login"
                                        name="login" :value="old('login')"
                                        required autofocus autocomplete="username"
                                        placeholder="Enter your Username/Email/Phone" />
                                </div>

                                <div class="mb-1 form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <div
                                        class="input-group input-group-merge">
                                        <input
                                            type="password"
                                            id="password"
                                            name="password"
                                            required autocomplete="current-password"
                                            class="password form-control p-2"
                                            placeholder="Enter your password" />

                                        <!-- <div
                                            class="input-group-text"
                                            data-password="false">
                                            <span
                                                class="password-eye"></span>
                                        </div> -->
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            id="remember_me"
                                            name="remember"
                                            checked />
                                        <label
                                            class="form-check-label "
                                            for="remember_me">Remember me</label>
                                    </div>
                                </div>

                                <div class="text-center d-grid">
                                    <button
                                        class="btn btn-success rounded-pill p-2"
                                        type="submit">
                                        Log In
                                    </button>
                                </div>
                            </form>

                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->


                    <!-- end row -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt">
        2015 -
        <script>
            document.write(new Date().getFullYear());
        </script>
        &copy; POS SYSTEM by
        <a href="" class="text-white-50">ESPA GROUP</a>
    </footer>

    <!-- Vendor js -->
    <script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>
    <!-- toastr js -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @if(Session::has('message'))
    <script>
        var type = "{{ Session::get('alert-type','info') }}";
        var message = "{{ Session::get('message') }}";
        switch (type) {
            case 'info':
                toastr.info(message);
                break;

            case 'success':
                toastr.success(message);
                break;

            case 'warning':
                toastr.warning(message);
                break;

            case 'error':
                toastr.error(message);
                break;
        }
    </script>
    @endif
</body>

</html>