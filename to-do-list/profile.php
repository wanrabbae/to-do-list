<?php

require 'backend/funcs.php';

if (!isset($_SESSION["login"])) {
    header("Location: assets/pages/login.php");
}

$id = $_GET["id"];

$result = mysqli_query($connect, "SELECT * FROM users WHERE id = '$id'");
$result2 = mysqli_fetch_assoc($result);

if (isset($_POST["gantiUsername"])) {
    gantiUsername();
} elseif (isset($_POST["gantiPassword"])) {
    gantiPassword();
} elseif (isset($_POST["gantiGambar"])) {
    gantiGambar();
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/profile2.css">
    <title>Informasi User</title>
</head>

<body>

    <div class="container">
        <div class="header">
            <h3 class="text-center title">Informasi User</h3>
        </div>
        <div class="body">
            <div class="profile justify-content-center">
                <img src="assets/img/<?= $result2["profile"]; ?>" alt="" class="img-profile">
                <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="gambar"></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="hidden" name="id" id="id" value="<?= $result2["id"]; ?>">
                                <input type="file" name="gambar" class="custom-file-input" id="gambar" onchange="munculNamaGambar()" required>
                                <label class="custom-file-label" for="gambar">Pilih foto profile...</label>
                            </div>
                        </div>
                        <?php if (isset($foto_error)) : ?>
                            <span class="text-danger"><?= $foto_error; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="gantiGambar" class="btn btn-outline-primary btn-block">Ganti
                            Gambar</button>
                    </div>
                </form>
            </div>
            <div class="username-info">
                <form action="" method="post" autocomplete="off">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="usr">Username : </label>
                            <input type="hidden" name="id" id="id" value="<?= $result2["id"]; ?>">
                            <input type="text" name="usr" class="form-control" id="usr" required value="<?= $result2["username"]; ?>">
                            <?php if (isset($username_error)) : ?>
                                <span class="text-danger"><?= $username_error; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="gantiUsername" class="btn btn-outline-primary btn-block">Simpan
                                Username</button>
                        </div>
                    </div>
                </form>
            </div>
            <hr>
            <div class="password-info">
                <h4>Password: </h4>
                <?php if (isset($password_success)) : ?>
                    <span class="text-success"><?= $password_success; ?></span>
                <?php endif; ?>
                <form action="" method="post" autocomplete="off">
                    <div class="form-group mt-3">
                        <input type="hidden" name="id" id="id" value="<?= $result2["id"]; ?>">
                        <div class="form-group">
                            <label for="pwd-old">Password lama : </label>
                            <input type="password" name="pwd-old" required class="form-control" id="pwd-old">
                            <?php if (isset($password_error)) : ?>
                                <span class="text-danger"><?= $password_error; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="pwd-baru">Password baru : </label>
                            <input type="password" name="pwd-baru" required class="form-control" id="pwd-baru">
                            <?php if (isset($password2_error)) : ?>
                                <span class="text-danger"><?= $password2_error; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="pwd2-baru">Konfirmasi password baru : </label>
                            <input type="password" name="pwd2-baru" required class="form-control" id="pwd2-baru">
                            <?php if (isset($password3_error)) : ?>
                                <span class="text-danger"><?= $password3_error; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="gantiPassword" class="btn btn-outline-primary btn-block">Ganti
                                Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer mt-4">
            <footer class="ml-auto">
                <a href="index.php?id=<?= $result2["id"]; ?>" class=" btn-md btn btn-outline-primary">Back</a>
                <a href="backend/logout.php" class=" btn-md btn btn-outline-danger">Logout</a>
                <a href="backend/deleteAccount.php?id=<?= $result2["id"]; ?>" class="btn-md btn btn-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus akun kamu ?')">Hapus
                    Akun</a>

                <br><br>
                <span>© 2021 Copyright: <a href="https://alwan-portfolio.wanrabbae.repl.co/" target="_blank">Alwan</a>
                    and <a href="https://owlnxx.github.io/portfolio/" target="_blank">Faza</a>. All rights
                    reserved.</span>
            </footer>
        </div>
    </div>


    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- My JS -->
    <script src="assets/js/script.js"></script>
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