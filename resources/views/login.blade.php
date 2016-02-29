<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DMS | Login</title>

    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{URL::asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name" style="font-size:1000%">DMS</h1>

            </div>
            <h3>Welcome to Distribution Management System</h3>
           <!-- <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            <!--</p> -->
            <p>Login in. To see it in action.</p>
            <form class="m-t" role="form" action="index.html">
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
            </form>
            <p class="m-t"> <small>Nilesh Jayanandana &copy; {{date('Y')}}</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{URL::asset('js/jquery-2.1.1.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>

</body>

</html>
