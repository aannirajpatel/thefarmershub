<?php
require("../includes/auth.php");
require("../includes/db.php");
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$uid = $_SESSION['uid'];
$articleCount=0;
$answerCount=0;
$res = mysqli_query($con, "SELECT phoneNumber, village, dist, state, email FROM account WHERE uid=$uid");
$row = mysqli_fetch_array($res);
$phone = $row['phoneNumber'];
$email = $row['email'];
$village = $row['village'];
$district = $row['dist'];
$state = $row['state'];
$questionCount=0;
$upCount = 0;
$downCount = 0;
$res = mysqli_query($con, "SELECT articleid FROM article WHERE uid=$uid");
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
$res = mysqli_query($con, "SELECT SUM(qupcount) AS uc FROM question WHERE uid= $uid");
if($res){
  $row = mysqli_fetch_array($res);
  $upCount=$row['uc'];
}
$res = mysqli_query($con, "SELECT SUM(qdowncount) AS dc FROM question WHERE uid= $uid");
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
      height: fill;
      min-height: 100%;
    }
    .bg {
      background-image: linear-gradient(to right bottom, #051937, #004872, #007d9e, #00b5b1, #12eba9);
      height: fill;
      min-height: 100%;
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
        <a class="nav-link" href="../articles/articles.php">Articles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../forum/forum.php">Forums</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../statistics/statistics.php">Statistics</a>
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
  <div class="card-header"><h3>Your Profile</h3></div>
  <div class="card-body">
    <table class="table table-striped">
    <tr><td>Name</td><td><?php echo $fname." ".$lname;?></td></tr>
    <tr><td>Phone</td><td><?php echo $phone;?></td></tr>
    <tr><td>E-mail</td><td><?php echo $email;?></td></tr>
    <tr><td>Village</td><td><?php echo $village;?></td></tr>
    <tr><td>District</td><td><?php echo $district;?></td></tr>
    <tr><td>State</td><td><?php echo $state;?></td></tr>
    </table>
  </div>
</div>
<br>
<div class="card" style="margin-bottom: 20px;">
  <div class="card-header"><h3>Activity on TFH</h3></div>
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