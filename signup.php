<?php
  //global variable----
  $alert=false;
  $alert2=false;
  if ($_SERVER["REQUEST_METHOD"]=="POST") {
       require 'partials/_dbconnect.php';
       $username = $_POST['username'];
       $password = $_POST['password'];
       $cpassword = $_POST['cpassword'];

       //check where username exits
       $exitsql ="SELECT * FROM `users` WHERE `username`='$username'";
       $result = mysqli_query($connect,$exitsql);
       $existnum = mysqli_num_rows($result);
       if ($existnum>0) {
         // $exists = true;
         $showUser ='Username Already Exist.';
         $alert2 = true;
       }else{
         // $exists = false;
              if (($password == $cpassword)) {
                $hash = password_hash($password,PASSWORD_DEFAULT);
             // $sql = "INSERT INTO `users` (`sno`, `username`, `password`, `dt`) VALUES (NULL, '$username', '$password', current_timestamp())";
            $sql = "INSERT INTO `users` (`sno`, `username`, `password`, `dt`) VALUES (NULL, '$username', '$hash', current_timestamp())";
             $result2 = mysqli_query($connect,$sql);
             // Check for the table creation success
             if ($result2) {
                 $alert = true;
             } else {
                 echo 'Error '.mysqli_error($connect);
             }
       }
       else{
         $showUser = 'Password do not match .';
         $alert2 = true;
       }
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
            <strong>Success !!</strong> Your account have been Successfully created & You May Login.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  if ($alert2) {
    // code...
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oops !!</strong> '.$showUser.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
   ?>



  <div class="container my-4 col-md-4 signupclass">
    <h1 class="text-center"><strong>Sign Up My Website</strong></h1>
    <hr>
    <form action="/log-in/signup.php" method="post">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" maxlength="20" name="username" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" maxlength="20"length id="password" name="password">
        </div>
        <div class="mb-3">
          <label for="cpassword" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="cpassword" name="cpassword">
          <div  class="form-text">Make sure to type same password.</div>
        </div>
        <button type="submit" class="btn btn-primary text-center">Sign Up</button>
  </form>
  </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
