<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Score Management System</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('dist/css/myCss.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <style>
        body {
            background-image: url("{{ asset('imge/bg6.jpg') }}") !important;
            background-size: cover;
        }
    </style>
</head>

<body class="hold-transition d-flex justify-content-center align-items-center p-3" style="height: 100vh">
    <div class="login-box d-flex h400">
        <!-- /.login-logo -->
        <div class="card col-sm-12 col-md-6 h400" style="margin-right:40px;">
            <div class="card-body login-card-body">
                <div class="text-center">
                    <img src="{{ asset('imge/default_image.jpeg') }}" class="img-fluid login_default_img default_img"
                        alt="">
                </div>
                <p class="login-box-msg">Sign in </p>

                <form action="/login" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                            placeholder="name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" value="{{ old('password') }}" class="form-control"
                            placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                {{-- <p class="mb-1">
                    <a href="#">I forgot my password</a>
                </p> --}}

            </div>
        </div>
        <div class="d-none d-md-inline col-md-6 h400">
            <img src="{{ asset('imge/agency.png') }}" class="img-fluid" alt="">
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    @if (session('success'))
        <script type="text/javascript">
            $(document).ready(function() {
                toastr.success('{{ session('success') }}');
            });
        </script>
    @elseif ($errors->any())
        <script type="text/javascript">
            $(document).ready(function() {
                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}');
                @endforeach
            });
        </script>
    @elseif(session('error'))
        <script type="text/javascript">
            $(document).ready(function() {
                toastr.error('{{ session('error') }}');
            });
        </script>
    @endif



    {{-- @dump($errors->any()) --}}
</body>

</html>
