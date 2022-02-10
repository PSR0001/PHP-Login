<?php
$servername ="localhost";
$username = "root";
$password = "";
$database = "users";

$connect = mysqli_connect($servername,$username,$password,$database);
if($connect){}
else{
  die('Error'.mysqli_connect_error());
}
 ?>
