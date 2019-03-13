<?php
require("../includes/auth.php");
include("../includes/db.php");
if(!isset($_REQUEST['q'])){
	header('../dashboard/dashboard.php');
}
$qno = $_REQUEST['q'];

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
		<title>Add answer</title>
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
					<div class="card-header">Question: <?php echo $qtext;?></div>
					<div class="card-body">
						<form class="form-horizontal" role="form" action="adda.php" method="POST">
							<textarea class="form-control" rows="5" cols = 50 id="comment" name="answer" placeholder="Write your answer here">
							</textarea>
							<input type="hidden" name="q" <?php echo 'value="'.$qno.'"';?>>
							</input>
						</form>
						<input type="submit" name="Submit" value="Submit" />
					</div>
			</div>
		</div>
	</body>
</html>