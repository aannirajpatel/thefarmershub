<?php
require("../includes/auth.php");
//if(!isset($_SESSION['username'])){header('Location: ../login/login.php');}
//REMOVE THIS WHEN LOGIN IS DONE:
$username = $_SESSION["email"];
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
  background-image: linear-gradient(to right bottom, #051937, #004d7a, #008793, #00bf72, #a8eb12);

  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
   </style>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body class="bg">
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="#">The Farmer's Hub</a>
  
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link active" href="#">Dashboard</a>
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
<div class="card">
  <div class="card-header"><h3>View Your Profile</h3></div>
  <div class="card-body"><p>The .navbar-brand class is used to highlight the brand/logo/project name of your page.</p></div>
</div>
</div>
</body>
</html>