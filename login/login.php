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
    if($rows==1){
        $_SESSION['email'] = $email;
        $userRes = mysqli_fetch_array($result);
        $username = $userRes['username'];
        $_SESSION['username']=$username;
        $detailQuery = "SELECT `fname`,`lname`,`uid` FROM `account` WHERE `email` = '$email'";
        $detailRes = mysqli_query($con, $detailQuery) or die(mysqli_error($con));
        while ($detailRow = mysqli_fetch_array($detailRes, MYSQLI_BOTH)) {
            $_SESSION['fname'] = $detailRow['fname'];
            $_SESSION['uid'] = $detailRow['uid'];

        }
        header("Location: ../dashboard/dashboard.php");
    }
    else{
        echo "<div class='form'>
        <h3>User ID/Password is incorrect.</h3>
        <br/>Click here to <a href='login.php'>Login</a></div>";
    }
}
    
?>


<!DOCTYPE html>
<html lang="en">
<head>

<style type="text/css">
        body, html {
  height: 100%;
}
.bg {
  /* The image used */
  background-image: linear-gradient(to right top, #bf00ff, #f300bf, #ff00ff, #008793, #00bf72);

  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
   <title>Login Form</title>
   <meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">  
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>



<body class="bg">
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="#">The Farmer's Hub</a>
  
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link active" href="../index.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Blogs</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Forums</a>
    </li>
  </ul>
</nav>
<br><br>       
    
<div class="container">
 <h3>Welcome! Join the Indian Community of Farmers.</h3></a></p>
<hr>
<div class="row"></div>
	<aside class="col-sm-4">
<p> Login with your email</p>
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