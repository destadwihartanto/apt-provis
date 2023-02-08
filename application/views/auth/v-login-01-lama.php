<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Login System</title>

        <!-- Bootstrap core CSS -->
        <link href="<?=site_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?=site_url('assets/css/signin.css')?>" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <div class="container">

            <form class="form-signin" method="post" action="<?=base_url('auth/login')?>" enctype="multipart/form-data">
                <h2 class="form-signin-heading">Please sign in</h2>

                <p class="bg-warning"><?=$message;?></p>
                <label for="identity" class="sr-only">Email address</label>
                <input type="email" name="<?=$identity['name']?>" id="<?=$identity['id']?>" value="<?=$identity['value']?>" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="<?=$password['name']?>" id="<?=$password['id']?>" class="form-control" placeholder="Password" required>
                <div class="checkbox">
                    <label> <input type="checkbox" name="remember" value="1"> Remember me</label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>
        </div> <!-- /container -->
    </body>
</html>