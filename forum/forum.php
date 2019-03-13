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
  /* The image used */
  background-image: linear-gradient(to right bottom, #051937, #004d7a, #008793, #00bf72, #a8eb12);

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
		<div class = "card-header">
		<h3 style="display:inline;">Welcome to the TFH forums!</h3><h5 style="display: inline;"><a href="createquestion.php" style="float: right;">Ask a question</a></h5>
		</div>
		<div class = "card-body">
    <table class="table">
      <thead><th>User</th><th>Question</th><th width="4">Timestamp</th><th>Upvotes</th><th>Downvotes</th></thead>
      <?php
        $qry = "SELECT * FROM question ORDER BY (qupcount-qdowncount) DESC, qtimestamp DESC LIMIT 20";
        $result = mysqli_query($con, $qry) or die(mysqli_error($con));
        while($rows=mysqli_fetch_assoc($result)){
          $qry = "SELECT fname, lname FROM account WHERE uid=".$rows['uid'];
          $res = mysqli_query($con, $qry);
          $r = mysqli_fetch_assoc($res);
          echo "<tr>
            <td>".$r['fname']." ".$r['lname']."</td>
            <td>".$rows['qtext']."</td>
            <td>".$rows['qtimestamp']."</td>
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