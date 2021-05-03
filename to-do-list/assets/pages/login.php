<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/authentications.css">
    <title>Login</title>
</head>

<body>
    <div class="container login-box">
        <div class="header">
            <h3 class="text-center">Login</h3>
        </div>
        <hr>
        <?php if (isset($error_login)) : ?>
            <span class="text-danger mb-3"><?= $error_login; ?></span>
        <?php endif; ?>
        <form action="" method="post" autocomplete="off">
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" autofocus>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" name="login" class="btn btn-outline-primary btn-block">Login</button>
                <button type="reset" class="btn btn-outline-danger btn-block">Clear</button>
                <hr>
                <span>Don't Have an Account? <a href="register.php">Register
                        now!</a></span>
            </div>
        </form>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
</body>

</html>

<?php

require 'funcs.php';

session_start();

$id_usr = $_SESSION["usr_id"];

if (isset($_SESSION["login"])) {
    header("Location: ../../index.php?id=" . $id_usr);
}

if (isset($_POST["login"])) {
    login();
}

?>