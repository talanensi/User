<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
</head>
<body class="fixed-left">
    	
        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div class="accountbg">
            
            <div class="content-center">
                <div class="content-desc-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5 col-md-8">
                                <div class="card">
                                    <div class="card-body">
                
                                        <!-- <h3 class="text-center mt-0 m-b-15">
                                            <a href="index.html" class="logo logo-admin"><img src="{{ asset('assets/images/HRMS3.png')}}" height="30" alt="logo"></a>-
                                        </h3> -->
                            
                                        <h4 class="text-muted text-center font-18" ><b><center>Admin Login</center></b></h4>

                                        <div class="p-2">
                                            <form class="form-horizontal m-t-20" id="admin_login" action="{{ route('admin.login') }}" method="POST">
                                            @csrf
                                            <div class="form-group row">
                                                    <div class="col-12">
                                                        <input type="text" class="form-control {{ $errors->has('email')?'is-invalid':'' }}" placeholder="email" 
                                                        name="email" required>

                                                        @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <input type="password" class="form-control {{ $errors->has('password')?'is-invalid':'' }}" placeholder="Password" 
                                                        name="password" required>

                                                        @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                
                                                <div class="form-group text-center row m-t-20">
                                                    <div class="col-12">
                                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                                    </div>
                                                </div>
                
                                            </form>
                                        </div>
                
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('assets/js/detect.js') }}"></script>
        <script src="{{ asset('assets/js/fastclick.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('assets/js/waves.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>

        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        <script>
            $("#admin_login").validate({
                errorClass: 'invalid-feedback animated fadeInDown',
                errorElement: 'div',
                rules: {
                    email: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                },
                messages: {
                    email: {
                        required: "The email field is required.",
                    },
                    password: {
                        required: "The password field is required.",
                    },
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).parents("div.form-control").addClass(errorClass).removeClass(validClass);
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).parents(".error").removeClass(errorClass).addClass(validClass);
                }
            });
        </script>
</body>
</html>