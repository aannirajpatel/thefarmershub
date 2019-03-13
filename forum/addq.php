<?php
require("../includes/auth.php");
require("../includes/db.php");

// get data that sent from form
$question=$_REQUEST['question'];

//get user ID
$uid = $_SESSION['uid'];

$sql="INSERT INTO question(qtext,uid)VALUES('$question','$uid')";
$result=mysqli_query($con,$sql);

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
  <title>Create question</title>
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
      <a class="nav-link" href="../dashboard/dashboard.php">Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Articles</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="../forum/forum.php">Forums</a>
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
  <div class="card-header"><h3>
  	<?php
  	if($result){
  		echo 'Done!';
  		$sql = "SELECT MAX(qno) AS q FROM question WHERE uid=$uid";
  		$res = mysqli_query($con,$sql);
  		$res = mysqli_fetch_array($res);
  		$qno = $res['q'];
  	}
  	else{
  		echo 'Error';
  	}
  	?>
  </h3></div>
  <div class="card-body">

  	<?php

	if($result){
	echo 'Your question has been created. Click <a href="../dashboard/viewq.php?q='.$qno.'">here</a> to view your question.';
	}
	else {
	echo "We were unable to post your question. Please try again later.";
	}
	mysqli_close($con);
	?>

  </div>

</body>
</html>