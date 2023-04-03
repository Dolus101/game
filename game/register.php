<?php
session_start();

include("config.php");
include("function.php");

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $name = sec_input($_POST['name']);
    $username = sec_input($_POST['username']);
    $email = sec_input($_POST['email']); 
    $password = $_POST['password'];

    //if user and email already exist
    $sql = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $query = $con->query($sql);
    $row = $query->fetch_array();

    if($row)
    {
        if($row['username'] === $username)
        {
            echo('<script>alert("Username already taken");window.location = "register.php";</script>');
        exit();
        }

        if($row['email'] === $email)
        {
            echo('<script>alert("Email is already taken");window.location = "register.php";</script>');
        exit();
        }
    }
    // if user password and email is not empty
    if(!empty($username) && !empty($password) && !empty($email) && !empty($name))
    {
            $query = "insert into users (name,username,email,password) VALUES ('$name','$username','$email','$password')";

            mysqli_query($con,$query);
            header("Location: login.php");
            die;
    }else{
      echo('<script>alert("ehem");window.location = "register.php";</script>');
    }

}

function sec_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Roboto Condensed' rel='stylesheet'>
    <!-- CSS -->
    <link rel="stylesheet" href="css/register.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ethereal - Register</title>
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
<!-- Register Form -->
<div class="container d-flex justify-content-center center">
    <div class="register-form">
        <div class="img-logo">
            <img src="img/logo3.png" class="img-fluid mx-auto">
        </div>
        <form action="" method="POST">
          <div class="register-input">
              <h5>Name</h5>
              <input class="register-name" type="text" name="name">
              <h5>Username</h5>
              <input class="register-user" type="text" name="username">
              <h5>Password</h5>
              <input class="register-pass" type="password" name="password">
              <h5>Email</h5>
              <input class="register-email" type="email" name="email">
          </div>
        <div class="register-login">
            <input type="submit" class="btn btn-success" value="signup" name="reg-submit">
        </form>
            <a href="login.php">log in</a>
        </div>
    </div>
</div>
</body>
</html>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>