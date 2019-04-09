<?php
session_start();
if(isset($_SESSION['uid'])){
	$uid = $_SESSION['uid'];	
	$loggedIn=1;
}
else{
	$loggedIn=0;
}
require('../includes/db.php');
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
  background: linear-gradient(to right bottom, #051937, #004872, #007d9e, #00b5b1, #12eba9);
  height: fill;
  min-height: 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
   </style>
  <title>Articles</title>
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
    	<?php if($loggedIn==1){ ?>
      <li class="nav-item">
        <a class="nav-link" href="../dashboard/dashboard.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="../articles/articles.php">Articles</a>
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
	<?php } 
	else{
	?>
      <li class="nav-item">
        <a class="nav-link" href="../login/login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../signup/signup.php">Sign Up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="../articles/articles.php">Articles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../forum/forum.php">Forums</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../statistics/statistics.php">Statistics</a>
      </li>
	<?php } ?>
    </ul>
  </div>
    <form class="form-inline my-2 my-lg-0" style="float:right;" action="searcharticles.php" method="get">
      <input class="form-control mr-sm-2" name="search" style="width: 300px" type="search" placeholder="Search for any question" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</nav>
<br><br><br><br>
<div class="container">
	<div class="card">
		<div class = "card-header">
		<h3 style="display:inline;">Top 10 Articles Today</h3><h5 style="display: inline; float:right;"><a href="createarticle.php">Write an article here!</a></h5>
		</div>
		<div class = "card-body">
    <table class="table">
      <thead><th>User</th><th>Topic</th><th width="4">Posted</th><th>Comments</th><th>Upvotes</th><th>Downvotes</th></thead>
      <?php
        $qry = "SELECT * FROM article ORDER BY (upcount-downcount) DESC, `timestamp` DESC LIMIT 10";
        $result = mysqli_query($con, $qry) or die(mysqli_error($con));
        while($rows=mysqli_fetch_assoc($result)){
          $qryans = "SELECT count(*) AS commentcount 
          FROM comment 
          WHERE articleid= ".$rows['articleid'];
          $res = mysqli_query($con, $qryans);
          $rowans = mysqli_fetch_array($res);
          $qryname = "SELECT username FROM account WHERE uid=".$rows['uid'];
          $resname = mysqli_query($con, $qryname);
          $nameans = mysqli_fetch_array($resname);
          $name=$nameans['username'];
          echo "<tr>
            <td>".$name."</td>
            <td>".'<a href="viewarticle.php?articleid='.$rows['articleid'].'">'.$rows['topic']."</a></td>
            <td>".$rows['timestamp']."</td>
            <td style='color: blue'>".$rowans['commentcount']."</td>
            <td style='color: green'>".$rows['upcount']."</td>
            <td style='color: red'>".$rows['downcount']."</td>
            </tr>";
        }
      ?>
    </table>
	</div>
</div>
</body>
</html>