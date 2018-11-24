
<!DOCTYPE html>
<html lang="en-us" id="extr-page">
<head>
    <meta charset="utf-8">
    <title> SmartAdmin</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- #CSS Links -->
    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('fontView') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('fontView') }}/assets/css/font-awesome.min.css">

    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('fontView') }}/assets/css/smartadmin-production-plugins.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('fontView') }}/assets/css/smartadmin-production.min.css">


    <!-- #FAVICONS -->
    <link rel="shortcut icon" href="{{ asset('fontView') }}/assets/img/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" href="{{ asset('fontView') }}/assets/img/favicon/favicon.ico" type="image/x-icon">



</head>

<body class="animated fadeInDown">

<header id="header">
    <div id="logo-group">
        <span id="logo"> <img src="{{ asset('fontView') }}/assets/img/logo.png" alt="SmartAdmin"> </span>
    </div>
</header>

<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-xs hidden-sm">

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="well no-padding">

                        <form action="">
                            <section>
                                <label class="label">E-mail</label>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input type="text"  name="email">

                            </section>

                            <section>
                                <label class="label">Password</label>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                    <input type="password"  name="password">

                                <div class="note">
                                    <a href="javascript:void(0);">Forgot password?</a>
                                </div>
                            </section>
                        </fieldset>
                        <footer>
                            <button type="submit" name="submit" class="btn btn-primary">
                                Sign in
                            </button>
                        </footer>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<!--================================================== -->

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script src="{{ asset('fontView') }}/assets/js/plugin/pace/pace.min.js"></script>

<!-- Link the jquery file -->
<script src="{{ asset('fontView') }}/assets/js/libs/jquery.min.js"></script>

<script>
    if (!window.jQuery) {
        document.write('<script src="assets/js/libs/jquery-2.1.1.min.js"><\/script>');
    }
</script>

<script src="{{ asset('fontView') }}/assets/js/libs/jquery-ui.min.js"></script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="assets/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
    }
</script>

<!-- IMPORTANT: APP CONFIG -->
<script src="{{ asset('fontView') }}/assets/assets/js/app.config.js"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events
<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

<!-- BOOTSTRAP JS -->
<script src="{{ asset('fontView') }}/assets/js/bootstrap/bootstrap.min.js"></script>

<!-- JQUERY VALIDATE -->
<script src="{{ asset('fontView') }}/assets/js/plugin/jquery-validate/jquery.validate.min.js"></script>

<!--[if IE 8]>

<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

<![endif]-->

<!-- MAIN APP JS FILE -->
<script src="{{ asset('fontView') }}/assets/js/app.min.js"></script>


</body>
</html>