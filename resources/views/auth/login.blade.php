<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Login | Tata</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body class="auth-body-bg">
        <div>
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-4">
                        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                            <div class="w-100">
                                <div class="row justify-content-center">
                                    <div class="col-lg-9">
                                        <div>
                                            <div class="text-center">
                                                <div>
                                                    <a href="index.html" class="">
                                                        <img src="assets/images/uptree.jpg" alt="" height="50" class="auth-logo logo-dark mx-auto">
                                                        <img src="assets/images/uptree.jpg" alt="" height="50" class="auth-logo logo-light mx-auto">
                                                    </a>
                                                </div>
    
                                                <h4 class="font-size-18 mt-4">Welcome Back !</h4>
                                                <p class="text-muted">Sign in to continue to Pigeon App</p>
                                            </div>

                                            <div class="p-2 mt-5">
                      <form class="theme-form login-form" method="post" action="{{ route('login') }}">
                              @csrf
                              <x-jet-validation-errors class="mb-4" />
                             

                              <div class="mb-3 auth-form-group-custom mb-4">
                                <i class="ri-user-2-line auti-custom-input-icon"></i>
                                <label for="email">Email</label>
                                <input name="email" type="email" class="form-control" id="email" placeholder="Enter Email" required>
                            </div>

                            <div class="mb-3 auth-form-group-custom mb-4">
                                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                <label for="password">Password</label>
                                <input  name="password" type="password" class="form-control" id="password" placeholder="Enter password" required>
                            </div>
                            <div class="form-check">
                                <input name="remember" type="checkbox" class="form-check-input" id="customControlInline">
                                <label class="form-check-label" for="customControlInline">Remember me</label>
                            </div>

                             
                            <div class="mt-4 text-center">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                        </div>
                        
                            </form>
                                            </div>

                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="authentication-bg">
                            <div class="bg-overlay"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/js/app.js"></script>

    </body>
</html>