<?php
require("../includes/auth.php");
require("../includes/db.php");
$fname = $_SESSION['fname'];
$uid = $_SESSION['uid'];
$articleCount=0;
$answerCount=0;
$questionCount=0;
$upCount = 0;
$downCount = 0;
$res = mysqli_query($con, "SELECT articleid FROM articles WHERE uid=$uid");
if($res){
  $articleCount = mysqli_num_rows($res);
}
$res = mysqli_query($con, "SELECT qno FROM answer WHERE uid=$uid");
if($res){
  $answerCount = mysqli_num_rows($res);
}
$res = mysqli_query($con, "SELECT qno FROM question WHERE uid=$uid");
if($res){
  $questionCount = mysqli_num_rows($res);
}
$res = mysqli_query($con, "SELECT SUM(qupcount) AS uc FROM question WHERE uid=$uid");
if($res){
  $row = mysqli_fetch_array($res);
  $upCount=$row['uc'];
}
$res = mysqli_query($con, "SELECT SUM(qdowncount) AS dc FROM question WHERE uid=$uid");
if($res){
  $row = mysqli_fetch_array($res);
  $downCount=$row['dc'];
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
  background-image: linear-gradient(to right top, #ff6600, #ff3f6c, #f052b7, #a376e6, #128deb);
  height: 100%;
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
<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
  <a class="navbar-brand" href="#">TFH</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
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
  </div>
    <form class="form-inline my-2 my-lg-0" style="float:right;" action="../forum/searchq.php" method="get">
      <input class="form-control mr-sm-2" name="search" style="width: 300px" type="search" placeholder="Search for any question" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</nav>
<br><br><br><br>
<div class="container">
<div class="card">
  <div class="card-header"><h3><?php echo "$fname"?>'s Profile</h3></div>
  <div class="card-body">
    <table class="table table-striped">
    <tr><td>Article posts</td><td><?php echo $articleCount;?></td></tr>
    <tr><td>Question posts</td><td><?php echo $questionCount;?></td></tr>
    <tr><td>Answer posts</td><td><?php echo $answerCount;?></td></tr>
    <tr><td>Total Question Upvotes</td><td><?php echo $upCount;?></td></tr>
    <tr><td>Total Question Downvotes</td><td><?php echo $downCount;?></td></tr>
    </table>
  </div>
</div>
</div>
</body>
</html> 