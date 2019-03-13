<?php
require("../includes/auth.php");
require("../includes/db.php");
//if(!isset($_SESSION['username'])){header('Location: ../login/login.php');}
//REMOVE THIS WHEN LOGIN IS DONE:
$fname = $_SESSION['fname'];
$uid = $_SESSION['uid'];
$articleCountRes = "SELECT COUNT(*) FROM articles WHERE username";
$articleCount=0;
$questionCount=0;
$upCount = 0;
$downCount = 0;
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
  background-image: linear-gradient(to right bottom, #051937, #004872, #007d9e, #00b5b1, #12eba9);

  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
   </style>
  <title>Dashboard</title>
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
      <a class="nav-link active" href="../dashboard/dashboard.php">Dashboard</a>
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
    <li class="nav-item">
      <a class="nav-link" href="../logout/logout.php">Logout</a>
    </li>
  </ul>
</nav>
<br><br>
<div class="container">
<div class="card">
  <div class="card-header"><h3><?php echo "$fname"?>'s Profile</h3></div>
  <div class="card-body">
    <table class="table table-striped">
    <tr><td>Article posts</td><td><?php echo $articleCount;?></td></tr>
    <tr><td>Question posts</td><td><?php echo $questionCount;?></td></tr>
    <tr><td>Total Upvotes</td><td><?php echo $upCount;?></td></tr>
    <tr><td>Total Downvotes</td><td><?php echo $downCount;?></td></tr>
    </table>
  </div>
</div>
</div>
</body>
</html> 