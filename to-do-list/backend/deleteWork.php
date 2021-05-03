<?php

require 'funcs.php';

$id_work = $_GET["id"];
$id = $_GET["id_user"];

deletedWork($id_work);

header("Location: ../index.php?id=" . $id);
