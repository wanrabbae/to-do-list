<?php

$connect = mysqli_connect("sql209.epizy.com", "epiz_28185622", "4sk0Pi7VLlHLs", "epiz_28185622_phptodolist");

if (!$connect) {
    echo "<script>
            alert('Tidak terhubung ke database!')
        </script>";
}

// REGISTER

function uploadGambarBuku()
{
    global $connect, $foto_error;
    $namaGambar = $_FILES["gambar"]["name"];
    $tmpGambar = $_FILES["gambar"]["tmp_name"];
    $errorGambar = $_FILES["gambar"]["error"];
    $sizeGambar = $_FILES["gambar"]["size"];

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
    $target_path = '../img/' . $namaGambarBaru;

    // pindahkan file
    move_uploaded_file($tmpGambar, $target_path);

    return $namaGambarBaru;
}

$username_error = $password_error = $password2_error = $foto_error = "";
function register()
{
    global $connect,
        $username_error,
        $password_error,
        $password2_error,
        $foto_error;

    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $password2 = htmlspecialchars($_POST["password2"]);
    $foto = uploadGambarBuku();


    // VALIDATION USERNAME
    $result_usr = mysqli_query($connect, "SELECT * FROM users WHERE username = '$username'");
    if (empty($username)) {
        $username_error = "Username wajib di isi!";
        return false;
    } elseif (mysqli_fetch_assoc($result_usr)) {
        $username_error = "Username yang anda masukan sudah terdaftar!";
        return false;
    } elseif (!preg_match('/^[a-zA-Z\d]+$/', $username)) {
        $username_error = "Username hanya berisi huruf dan angka. tidak boleh spasi atau karakter spesial!";
        return false;
    }

    // VALIDATION USERNAME

    // VALIDATION PASSWORD
    if (!preg_match('/^[a-zA-Z\d]+$/', $password)) {
        $password_error = "Password hanya berisi huruf dan angka saja. tidak boleh spasi atau karakter spesial!";
        return false;
    } elseif ($password2 !== $password) {
        $password2_error = "Konfirmasi password tidak cocok!";
        return false;
    } elseif (strlen($password) < 7) {
        $password_error = "Password minimal 7 karakter atau lebih!";
        return false;
    }

    // VALIDATION PASSWORD

    // VALIDATION FOTO
    if (!$foto) {
        return false;
    }
    // VALIDATION FOTO

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // INSERT DBMS
    $query = "INSERT INTO users (`id`, `profile`, `username`, `password`) VALUES (NULL, '$foto', '$username', '$password')";
    mysqli_query($connect, $query);

    echo "<script>
            alert('Register berhasil!');
            document.location.href = 'login.php';
        </script>";
}


// REGISTER

// LOGIN
$error_login = $row = "";
function login()
{
    global $connect, $error_login, $row;

    $usr = htmlspecialchars($_POST["username"]);
    $pwd = htmlspecialchars($_POST["password"]);

    if (empty($usr) || empty($pwd)) {
        $error_login = "Username atau Password tidak boleh kosong!";
        return false;
    }

    $result = mysqli_query($connect, "SELECT * FROM users WHERE username = '$usr' ");
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) === 1) {
        // cek password
        if (password_verify($pwd, $row["password"])) {
            $_SESSION["login"] = true;
            echo "<script>
                    alert('Login berhasil!');
                </script>";
            header("Location: ../../index.php?id=" . $row["id"]);
        } else {
            $error_login = "Username atau Password yang anda masukan salah!";
        }
    } else {
        $error_login = "Username atau Password yang anda masukan salah!";
    }
}
