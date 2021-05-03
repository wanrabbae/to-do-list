<?php

require 'backend/funcs.php';

if (!isset($_SESSION["login"])) {
  header("Location: assets/pages/login.php");
}

$id = $_GET["id"];

$result = mysqli_query($connect, "SELECT * FROM users WHERE id = '$id'");
$result2 = mysqli_fetch_assoc($result);
$user = $result2["username"];

$_SESSION["usr_id"] = $result2["id"];

$work = query("SELECT * FROM `to-do` WHERE user = '$user' ");


if (isset($_POST["workButton"])) {
  works($result2["username"]);
} elseif (isset($_POST["edit"])) {
  edit();
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- Font -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">

  <title>To Do List</title>
</head>

<body>

  <div class="username">
    <p>Hai, <span><?= $result2["username"]; ?></span></p>
  </div>

  <div class="profile-img ml-auto">
    <a href="profile.php?id=<?= $result2["id"]; ?>"><img src="assets/img/<?= $result2["profile"]; ?>" class="img-profile rounded-cricle" alt=""></a>
  </div>

  <form method="post" action="" autocomplete="off">
    <div class="input-div">
      <input type="text" class="div" name="work" placeholder="Enter the work" required autofocus value="">
      <button type="submit" name="workButton" class="plusButton"><i class="fas fa-plus fa-2x"></i></button>
    </div>
  </form>

  <div class="wrapper">
    <?php foreach ($work as $row) : ?>
      <ul>
        <li>
          <form action="">
            <input type="checkbox" name="check" id="check">
          </form>
        </li>
        <li class="work"><?= $row["work"]; ?></li>
        <li class="aksi">
          <a href="" class="editWork" data-toggle="modal" data-target="#modal_edit" data-id="<?= $row["id"]; ?>" id="trash">
            <i class="fas fa-pen text-primary" id="pen"></i>
          </a>
          <a href="backend/deleteWork.php?id=<?= $row["id"]; ?>&id_user=<?= $id; ?>" id="trash">
            <i class="fas fa-trash" id="trash"></i>
          </a>
        </li>
      </ul>
    <?php endforeach; ?>
  </div>

  <footer class="text-white">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2021 Copyright: <a href="https://alwan-portfolio.wanrabbae.repl.co/" target="_blank">Alwan</a> and <a href="https://owlnxx.github.io/portfolio/" target="_blank">Faza</a>. All rights reserved.
    </div>
    <!-- Copyright -->
  </footer>


  <!-- Modal Edit -->

  <div class="modal fade" tabindex="-1" id="modal_edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Edit</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="editList">New Work</label>
              <input type="hidden" name="id" id="id_work">
              <input type="text" name="editList" required id="editList" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" name="edit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit -->


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <!-- Font Awesome icons free version-->
  <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <!-- My JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>

  <script src="assets/js/script2.js"></script>

  <script>
    $('.editWork').on('click', function() {
      $('#id_work').val($(this).data('id'));

      $('#editList').val('');
      $('.modal').css('margin-top', '6em');
    });
  </script>
</body>

</html>