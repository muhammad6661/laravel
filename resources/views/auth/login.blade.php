<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Login | Nazox - Responsive Bootstrap 4 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/public/assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="/public/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/public/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body class="auth-body-bg">

        <div>
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-lg-4">
                        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                            <div class="w-100">
                                <div class="row justify-content-center">
                                    <div class="col-lg-9">
                                        <div>
                                            <div class="text-center">
                                                <div>
                                                    <a href="index.html" class="logo"><img src="/public/logo.png"  alt="logo"></a>
                                                </div>

                                                <h4 class="font-size-18 mt-4">Добро пожаловать !</h4>
                                            </div>

                                            <div class="p-2 mt-5">
                                              @include('includes.errors')
                                                <form class="form-horizontal" action="/login-check" method="POST">
                                                @csrf
                                                    <div class="form-group auth-form-group-custom mb-4">
                                                        <i class="ri-user-2-line auti-custom-input-icon"></i>
                                                        <label for="username">Email</label>
                                                        <input type="text" class="form-control" name="email" placeholder="email">
                                                    </div>

                                                    <div class="form-group auth-form-group-custom mb-4">
                                                        <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                        <label for="userpassword">Пароль</label>
                                                        <input type="password" class="form-control" name="password" placeholder="пароль">
                                                    </div>


                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="remember" id="customControlInline">
                                                        <label class="custom-control-label" for="customControlInline">Остаться в системе</label>
                                                    </div>
                                                    <div class="mt-4 text-center">
                                                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Выйти</button>
                                                    </div>

                                                </form>
                                            </div>

                                            <div class="mt-5 text-center">

                                                <p>© 2020 PBO-EITI. Создано в  <i class="mdi mdi-heart text-danger"></i>  Gravity studio</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="authentication-bg">

                                <img src="/public/image/Frame-42.jpg" height="100%" width="100%">

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- JAVASCRIPT -->
        <script src="/public/assets/libs/jquery/jquery.min.js"></script>
        <script src="/public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/public/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="/public/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/public/assets/libs/node-waves/waves.min.js"></script>

        <script src="/public/assets/js/app.js"></script>

    </body>
</html>
