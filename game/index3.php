<?php
session_start();

    include("function.php");
    include("config.php");
    
    $user_data = check_login($con);
// Change Password
    if(isset($_POST['change-pass']))
{
  $old_pass=$_POST['old-password'];
  $new_pass=$_POST['new-password'];
  $cnew_pass=$_POST['confirm-password'];
  if($new_pass == $cnew_pass)
  {
    $query = "select * from users where password = '$old_pass' limit 1";
    $result = mysqli_query($con,$query);
    $count = mysqli_num_rows($result);
    if($count > 0)
    {
      $sql = "update users set password = '$new_pass' where id = '".$_SESSION['id']."'";
      mysqli_query($con,$sql);
      echo('<script>alert("Password has been updated");window.location = "index.php";</script>');
    }
    else
    {
      echo('<script>alert("Old Password is Incorrect");window.location = "index.php";</script>');
    }

  }
  else
  {
    echo('<script>alert("New Password and Confirm New Password does not match");window.location = "index.php";</script>');
  }
}

//Change Email

if(isset($_POST['change-email']))
{
  $email=$_POST['email'];
  $current_pass=$_POST['current-password'];
  if(!empty($email))
  {
    $query = "select * from users where password = '$current_pass' limit 1";
    $result = mysqli_query($con,$query);
    $count = mysqli_num_rows($result);
    if($count > 0)
    {
      $sql = "update users set email = '$email' where id = '".$_SESSION['id']."'";
      mysqli_query($con,$sql);
      echo('<script>alert("Email has been updated");window.location = "index.php";</script>');
    }
    else
    {
      echo('<script>alert("Password is Incorrect");window.location = "index.php";</script>');
    }

  }
  else
  {
    echo('<script>alert("Please Enter email");window.location = "index.php";</script>');
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
    <link rel="stylesheet" href="css/index2.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Manager</title>
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
            <a class="nav-link login active" href="logout.php">logout</a>
          </li>
      </ul>
    </div>
  </div>
</nav>
<!-- navbar end -->
<!-- manage account -->
<div class="container">
  <div class="row mx-auto">
    <div class="col-md-4 col-lg-4 left-main">
      <div class="settings">
          <div class="settings-title">
            <h3>Settings</h3>
          </div>
          <div class="settings-main">
          <h5>
          <button type="button" class="btn-password" data-bs-toggle="modal" data-bs-target="#passwordModal">
            Change Password
          </button>
          </h5>
            <h5>
            <button type="button" class="btn-password" data-bs-toggle="modal" data-bs-target="#emailModal">
            Change Email
            </button>
            </h5>
            <h5> 
            <button type="submit" class="btn-password" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Change Profile
            </button> 
            </h5>
          </div>
      </div>
    </div>
    <div class="col-md-8 col-lg-6 right-main">
      <div class="account-info">
        <div class="account-title">
          <h3>Account Info</h3>
        </div>
        <div class="account-img">
          <img src="img/user2.png">
        </div>
        <div class="account-main">
          <h6>Name: <?php echo $user_data['name'];?></h6>
          <h6>User: <?php echo $user_data['username'];?></h6>
          <h6>Email: <?php echo $user_data['email'];?></h6>
          <h6>Date Created: <?php echo $user_data['date'];?></h6>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- change password modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <h6>Current Password</h6>
        <input type="password" name="old-password">
        <h6>New Password</h6>
        <input type="password" name="new-password">
        <h6>Confirm New Password</h6>
        <input type="password" name="confirm-password">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Change Password" name="change-pass">
      </div>
      </form>
    </div>
  </div>
</div>
<!-- change email modal -->
<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <h6>Change Email</h6>
        <input type="email" name="email">
        <h6>Current Password</h6>
        <input type="password" name="current-password">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Change Email" name="change-email">
      </div>
      </form>
    </div>
  </div>
</div>
<!-- change profile -->
<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ..............
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



</body>
</html>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>