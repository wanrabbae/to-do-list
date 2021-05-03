<?php

require 'funcs.php';

session_start();

$id_usr = $_SESSION["usr_id"];

if (isset($_SESSION["login"])) {
    header("Location: ../../index.php?id=" . $id_usr);
}


if (isset($_POST["register"])) {
    register();
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/authentications.css">
    <title>Register</title>
</head>

<body>
    <div class="container register-box">
        <div class="header">
            <h3 class="text-center">Register</h3>
        </div>
        <hr>
        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
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
                <?php if (isset($username_error)) : ?>
                    <span class="text-danger"><?= $username_error; ?></span>
                <?php endif; ?>
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
                <?php if (isset($password_error)) : ?>
                    <span class="text-danger"><?= $password_error; ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="password2">Konfirmasi Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>
                    <input type="password" name="password2" id="password2" class="form-control" placeholder="Konfirmasi Password">
                </div>
                <?php if (isset($password2_error)) : ?>
                    <span class="text-danger"><?= $password2_error; ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="foto">Upload Foto Profile</label>
                <div class="custom-file">
                    <input type="file" name="gambar" onchange="munculNamaGambar()" class="custom-file-input" id="gambar">
                    <label class="custom-file-label" for="gambar">Pilih Foto Profile...</label>
                </div>
                <?php if (isset($foto_error)) : ?>
                    <span class="text-danger"><?= $foto_error; ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <button type="submit" name="register" class="btn btn-outline-primary btn-block">Register</button>
                <button type="reset" class="btn btn-outline-danger btn-block">Clear</button>
                <hr>
                <span>Already Have an Account? <a href="login.php">Login
                        now!</a></span>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <script>
        function munculNamaGambar() {
            const sampul = document.querySelector('#gambar');
            const sampulLabel = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview');
            // Agar muncul nama file gambarnya 
            sampulLabel.textContent = sampul.files[0].name;
        }
    </script>
</body>

</html>