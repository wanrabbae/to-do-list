<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../assets/pages/login.php");
    return false;
}

require 'funcs.php';

$id = $_GET["id"];

deletedAccount($id);

session_destroy();
