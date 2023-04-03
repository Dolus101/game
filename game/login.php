<?php
session_start();
include("function.php");
// die($_SESSION['id']);
if(isset($_POST['submit'])){
    include("config.php");
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE `username` = '$username' AND `password` = '$password'";
    $query = $con->query($sql);
    $row = $query->fetch_array();

    if($query->num_rows != 0){
        $_SESSION['id'] = $row['id'];
        @header("Location: index.php");
        exit();
    } else {
      // die("Error: ".$con->error);
        echo('<script>alert("Wrong username or password!");window.location = "login.php";</script>');
        exit();
        
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Roboto Condensed' rel='stylesheet'>
    <!-- CSS -->
    <link rel="stylesheet" href="css/login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ethereal - Login</title>
</head>
<body>
    <!-- navbar start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-darker">
  <div class="container">
    <a class="navbar-brand ntitle" href="#"><b>Ethereal</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Game</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Store</a>
          </li>
      </ul>
      <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link login active" href="login.html">Login</a>
          </li>
      </ul>
    </div>
  </div>
</nav>
<!-- navbar end -->
<!-- login form -->
<div class="container d-flex justify-content-center center">
  <div class="login-form">
    <div class="img-logo">
        <img src="img/logo3.png" class="img-fluid mx-auto">
    </div>
    <form action="" method="POST">
    <div class="login-input mx-auto"> 
      <h5 class="login-user">Username</h5>
      <input id="login-user" type="text" name="username">
      <h5 class="login-pass">Password</h5>
      <input id="login-pass" type="password" name="password">
    </div>
    <div class="login-signup">
      <input type="submit" class="btn btn-success" value="login" name="submit">
    </form>
      <a href="register.php">Sign up</a>
    </div>
  </div>
</div>


</body>
</html>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>