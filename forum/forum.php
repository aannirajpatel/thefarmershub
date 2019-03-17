<?php
require('../includes/auth.php');
require('../includes/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style type="text/css">
        body, html {
  height: fill;
}
.bg {
  background-image: linear-gradient(to right top, #ff6600, #ff3f6c, #f052b7, #a376e6, #128deb);
  height: fill;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
   </style>
  <title>Forums</title>
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
        <a class="nav-link" href="../dashboard/dashboard.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Articles</a>
      </li>
      <li class="nav-item active">
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
    <form class="form-inline my-2 my-lg-0" style="float:right;" action="searchq.php" method="get">
      <input class="form-control mr-sm-2" name="search" style="width: 300px" type="search" placeholder="Search for any question" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</nav>
<br><br><br><br>
<div class="container">
	<div class="card">
		<div class = "card-header">
		<h3 style="display:inline;">Top Five Questions Today</h3><h5 style="display: inline; float:right;"><a href="createquestion.php">Ask a question</a></h5>
		</div>
		<div class = "card-body">
    <table class="table">
      <thead><th>User</th><th>Question</th><th width="4">Timestamp</th><th>Answers</th><th>Upvotes</th><th>Downvotes</th></thead>
      <?php
        $qry = "SELECT * FROM question ORDER BY (qupcount-qdowncount) DESC, qtimestamp DESC LIMIT 5";
        $result = mysqli_query($con, $qry) or die(mysqli_error($con));
        while($rows=mysqli_fetch_assoc($result)){
          $qryans = "SELECT count(*) AS cans FROM answer WHERE qno=".$rows['qno'];
          $res = mysqli_query($con, $qryans);
          $rowans = mysqli_fetch_array($res);
          $qryname = "SELECT fname, lname FROM account WHERE uid=".$rows['uid'];
          $resname = mysqli_query($con, $qryname);
          $nameans = mysqli_fetch_array($resname);
          $name=$nameans['fname']." ".$nameans['lname'];
          echo "<tr>
            <td>".$name."</td>
            <td>".'<a href="viewq.php?q='.$rows['qno'].'">'.$rows['qtext']."</a></td>
            <td>".$rows['qtimestamp']."</td>
            <td style='color: blue'>".$rowans['cans']."</td>
            <td style='color: green'>".$rows['qupcount']."</td>
            <td style='color: red'>".$rows['qdowncount']."</td>
            </tr>";
        }
      ?>
    </table>
	</div>
</div>
</body>
</html>