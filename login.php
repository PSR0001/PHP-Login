<?php
  //global variable----
  $alert=false;
  $alert2=false;
  if ($_SERVER["REQUEST_METHOD"]=="POST") {
        require 'partials/_dbconnect.php';
      $username = $_POST['username'];
      $password = $_POST['password'];

      // $sql = "SELECT * FROM `users` WHERE `username`='$username' AND `password`='$password'";
      $sql = "SELECT * FROM `users` WHERE `username`='$username'";
      $result = mysqli_query($connect,$sql);
      $num = mysqli_num_rows($result);

      if ($num == 1) {
          while ($rows = mysqli_fetch_assoc($result)) {
            if (password_verify($password,$rows['password'])) {
              $alert = true;
              session_start();
              $_SESSION['login']=true;
              $_SESSION['username']=$username;

              //redirect to welcome.php-->home page
              header("location: welcome.php");
            }else {
              $alert2=true;
             }
          }

      } else {
        $alert2=true;
       }
  }

 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>PHP-Sign-Up</title>
    <style >
      .signupclass{
        border: 1px solid grey;
        border-radius: 4px;
        padding-top: 6px;
        padding-bottom: 12px;
        box-shadow: 2px 2px 19px -6px rgba(0, 0, 0, 0.2);
        background-color: #f4f4f469;
      }
    </style>
  </head>
  <body>
  <?php require 'partials/_navbar.php' ?>

  <?php
  if ($alert) {
    // code...
  echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>Success !!</strong> You successfully Loged in.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  if ($alert2) {
    // code...
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oops !!</strong> Invaild credantials.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }

   ?>



  <div class="container my-4 col-md-4 signupclass">
    <h1 class="text-center"><strong>Login</strong></h1>
    <hr>
    <form action="/log-in/login.php" method="post">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary text-center">Login</button>
  </form>
  </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
