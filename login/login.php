<?php

require('../includes/db.php');

session_start();

if(isset($_POST['email'])){
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con,$email);

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con,$password);

    $query = "SELECT * FROM `account` WHERE email='$email' and password='".md5($password)."'";
    $result = mysqli_query($con,$query) or die(mysql_error());
    
    $rows = mysqli_num_rows($result);
    if($rows!=0){
        $_SESSION['email'] = $email;
        $userRes = mysqli_fetch_array($result);
        $username = $userRes['username'];
        $_SESSION['username']=$username;
        $detailQuery = "SELECT `fname`,`lname`,`uid` FROM `account` WHERE `email` = '$email'";
        $detailRes = mysqli_query($con, $detailQuery) or die(mysqli_error($con));
        while ($detailRow = mysqli_fetch_array($detailRes, MYSQLI_BOTH)) {
            $_SESSION['fname'] = $detailRow['fname'];
            $_SESSION['lname'] = $detailRow['lname'];
            $_SESSION['uid'] = $detailRow['uid'];
        }
        header("Location: ../dashboard/dashboard.php");
    }
    else{
        echo "<div class='alert alert-warning'>
        <br><br>Incorrect Email/Password. Click here to <a href='login.php'>try login again</a></div>";
    }
}
    
?>


<!DOCTYPE html>
<html lang="en">
<head>

<style type="text/css">
        body, html {
          height: fill;
          min-height: 100%;
}
.bg {
  background-image: linear-gradient(to right bottom, #051937, #004872, #007d9e, #00b5b1, #12eba9);
  min-height: 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
   <title>Login to TFH</title>
   <meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">  
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>
<body class="bg">
<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
  <a class="navbar-brand" href="#">TFH</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="../login/login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../signup/signup.php">Sign Up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Articles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../forum/forum.php">Forums</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Statistics</a>
      </li>
    </ul>
  </div>
    <form class="form-inline my-2 my-lg-0" style="float:right;" action="../forum/searchq.php" method="get">
      <input class="form-control mr-sm-2" name="search" style="width: 300px" type="search" placeholder="Search for any question" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</nav>
<br><br><br><br>       
<div class="container" style="color: white">
 <h3>Welcome! Join the Indian Community of Farmers.</h3></a></p>
<hr>
</div>
<div class="container">
<div class="row"></div>
	<aside class="col-sm-4">
<div class="card">
<article class="card-body">
<a href="../signup/signup.php" class="float-right btn btn-outline-primary">Sign up</a>
<h4 class="card-title mb-4 mt-1">Login</h4>
	<form method="POST" action="">
    <div class="form-group">
    	<label>Your email</label>
        <input name="email" class="form-control" placeholder="Enter your email" type="email">
    </div> <!-- form-group// -->
    <div class="form-group">
    	<a class="float-right" href="#">Forgot?</a>
    	<label>Your password</label>
        <input class="form-control" placeholder="Enter password" type="password" name="password">
    </div> <!-- form-group// --> 
    <div class="form-group"> 
    </div> <!-- form-group// -->  
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Login  </button>
    </div> <!-- form-group// -->                                                           
</form>
</article>
</div> <!-- card.// -->

	</aside> <!-- col.// -->
	<aside class="col-sm-4">
    </aside>
</body>
</html>