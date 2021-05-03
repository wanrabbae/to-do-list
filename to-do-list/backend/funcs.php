<?php

session_start();
$connect = mysqli_connect("sql209.epizy.com", "epiz_28185622", "4sk0Pi7VLlHLs", "epiz_28185622_phptodolist");

if (!$connect) {
    echo "<script>
            alert('Tidak terhubung ke database!')
        </script>";
}


// Read Work Data

function query($query)
{
    global $connect;
    $result = mysqli_query($connect, $query);
    $kotak = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $kotak[] = $row;
    }

    return $kotak;
}

// Read Work Data


// Works
$work_error = "";
function works($user)
{
    global $connect, $work_error, $id;

    $work = htmlspecialchars($_POST["work"]);

    $query = "INSERT INTO `to-do` (`id`, `user`, `work`) VALUES (NULL, '$user', '$work')";
    mysqli_query($connect, $query);

    header("Location: index.php?id=" . $id);
}

// Works

// Delete Work

function deletedWork($id_work)
{
    global $connect, $id;

    mysqli_query($connect, "DELETE FROM `to-do` WHERE id = '$id_work' ");
}

// Delete Work

// Edit Work

function edit()
{
    global $connect, $id;

    $editList = htmlspecialchars($_POST["editList"]);
    $id_work = htmlspecialchars($_POST["id"]);

    $query = "UPDATE `to-do` SET `work` = '$editList' WHERE `to-do`.`id` = '$id_work' ";
    mysqli_query($connect, $query);

    header("Location: index.php?id=" . $id);
}

// Edit Work


// Ganti username
$username_error = "";
function gantiUsername()
{
    global $connect, $username_error;

    $usr = htmlspecialchars($_POST["usr"]);
    $id = $_POST["id"];

    $result1 = mysqli_query($connect, "SELECT * FROM users WHERE username = '$usr'");
    $result2 = mysqli_fetch_assoc($result1);

    if ($usr == $result2["username"]) {
        return false;
    } elseif (!preg_match('/^[a-zA-Z\d]+$/', $usr)) {
        $username_error = "Username hanya berisi huruf dan angka. tidak boleh spasi atau karakter spesial!";
        return false;
    }

    $query = "UPDATE `users` SET `username` = '$usr' WHERE `users`.`id` = $id";
    mysqli_query($connect, $query);

    echo "<script>
            alert('Ganti username berhasil!');
        </script>";

    header("Location: profile.php?id=" . $id);
}

// Ganti username

// Ganti password
$password_error = $password2_error = $password3_error = "";
$password_success = "";
function gantiPassword()
{
    global $connect, $password_error, $password2_error, $password3_error, $password_success;

    $pwd_old = htmlspecialchars($_POST["pwd-old"]);
    $pwd_baru = htmlspecialchars($_POST["pwd-baru"]);
    $pwd2_baru = htmlspecialchars($_POST["pwd2-baru"]);
    $id = $_POST["id"];

    // VALIDATION PASSWORD
    if (!preg_match('/^[a-zA-Z\d]+$/', $pwd_old)) {
        $password_error = "Password hanya berisi huruf dan angka saja. tidak boleh spasi atau karakter spesial!";
        return false;
    } elseif (strlen($pwd_baru) < 7) {
        $password2_error = "Password minimal 7 karakter atau lebih!";
        return false;
    } elseif (!preg_match('/^[a-zA-Z\d]+$/', $pwd_baru)) {
        $password2_error = "Password hanya berisi huruf dan angka saja. tidak boleh spasi atau karakter spesial!";
        return false;
    } elseif ($pwd_baru !== $pwd2_baru) {
        $password3_error = "Konfirmasi password tidak cocok!";
        return false;
    }
    // VALIDATION PASSWORD


    $result = mysqli_query($connect, "SELECT * FROM users WHERE id = '$id' ");
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) === 1) {
        if (password_verify($pwd_old, $row["password"])) {
            $pwd_baru = password_hash($pwd_baru, PASSWORD_DEFAULT);
            $query = "UPDATE `users` SET `password` = '$pwd_baru' WHERE `users`.`id` = $id";
            mysqli_query($connect, $query);
            $password_success = "Ganti password berhasil!";
            echo "<script>
                    alert('Ganti password berhasil!');
                </script>";
            header("Location: profile.php?id=" . $id);
        } else {
            $password_error = "Password lama salah!";
            return false;
        }
    }
}

// Ganti password


// Ganti Gambar
$foto_error = "";
function gantiGambar()
{
    global $connect, $foto_error;
    $namaGambar = $_FILES["gambar"]["name"];
    $tmpGambar = $_FILES["gambar"]["tmp_name"];
    $errorGambar = $_FILES["gambar"]["error"];
    $sizeGambar = $_FILES["gambar"]["size"];
    $id = $_POST["id"];

    if ($errorGambar === 4) {
        $foto_error = "Foto profile wajib di upload!";
        return false;
    }

    // cek apakah yg di upload itu adalah gambar
    $extensiValid = ["jpg", "png", "jpeg"];
    $extensiGambar = explode(".", $namaGambar);
    $extensiGambar = strtolower(end($extensiGambar));

    if (!in_array($extensiGambar, $extensiValid)) {
        $foto_error = "Foto profile hanya boleh berekstensi jpg, png, jpeg !";
        return false;
    }

    // cek ukuran gambar
    if ($sizeGambar > 4000000) {
        $foto_error = "Ukuran foto tidak boleh lebih dari 4 mb!";
        return false;
    }

    // ganti dengan nama baru
    $namaGambarBaru = uniqid();
    $namaGambarBaru .= '.';
    $namaGambarBaru .= $extensiGambar;
    $target_path = 'assets/img/' . $namaGambarBaru;

    // pindahkan file
    move_uploaded_file($tmpGambar, $target_path);

    $resultGambar = mysqli_query($connect, "SELECT * FROM users WHERE id = $id ");
    $resultGambar2 = mysqli_fetch_assoc($resultGambar);

    unlink('assets/img/' . $resultGambar2["profile"]);

    $query = "UPDATE `users` SET `profile` = '$namaGambarBaru' WHERE `users`.`id` = $id";
    mysqli_query($connect, $query);

    echo "<script>
            alert('Ganti gambar berhasil!');
        </script>";

    header("Location: profile.php?id=" . $id);
}


// Ganti Gambar

// Delete Akun

function deletedAccount($id)
{
    global $connect;

    $resultGambar = mysqli_query($connect, "SELECT * FROM users WHERE id = $id ");
    $resultGambar2 = mysqli_fetch_assoc($resultGambar);

    unlink('../assets/img/' . $resultGambar2["profile"]);

    mysqli_query($connect, "DELETE FROM users WHERE id = '$id' ");
    header("Location: ../assets/pages/login.php");
}

// Delete Akun
