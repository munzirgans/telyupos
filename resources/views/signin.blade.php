<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/signstyle.css">
    <style>
        i.error, h4.error{
            color:red;
            font-weight:500;
        }
        input.error{
            border-bottom:1px solid red;
        }
    </style>
</head>
<body>

    <div class="main">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="judul">
                    <h1>TEL-U POS</h1>
                </div>
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="img/logo-smk10.jpeg" alt="sing up image"></figure>
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title" style="font-size:25px;margin-bottom:;" >Sign In</h2>
                        <form method="POST" class="register-form" id="login-form" action="{{route('user.signin')}}">
                            {{csrf_field()}}
                            @if($msg != "")
                                <h4 class="error">{{$msg}}</h4>
                                <?php $email = "error"; $password="error"; $error_email = ""; $error_password = '';?>
                            @else
                                <?php $email = "";$password = "";$error_email = ""; $error_password = '';?>
                                @if($errors->any())
                                    <?php $error_email = $errors->first('email');$error_password = $errors->first('password');?>
                                @endif
                                @if($errors->has('email'))
                                    <?php $email = "error";?>
                                @endif
                                @if($errors->has('password'))
                                    <?php $password = "error";?>
                                @endif
                            @endif
                                <h4 class="{{$email}}">{{$error_email}}</h4>
                                <div class="form-group">
                                    <label for="your_name"><i class="zmdi zmdi-account material-icons-name {{$email}}"></i></label>
                                    <input class="{{$email}}" type="text" name="email" placeholder="Email" value="{{old('email')}}"/>
                                </div>
                            <h4 class="{{$password}}">{{$error_password}}</h4>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock {{$password}}"></i></label>
                                <input class="{{$password}}" type="password" name="password" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Sign in"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
