<?php
session_start();

// if (!isset($_SESSION['login'])|| $_SESSION['login'] != true) {
//   header("location: login.php");
//   exit;
// }
session_unset();
session_destroy();
header("location: login.php");
exit;

 ?>
