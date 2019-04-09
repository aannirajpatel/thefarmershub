<?php
require("../includes/auth.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<style type="text/css">
		body, html {
		min-height: 100%;
		height: fill;
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
		<title>Write an article</title>
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
    </ul>
  </div>
    <form class="form-inline my-2 my-lg-0" style="float:right;" action="../forum/searchq.php" method="get">
      <input class="form-control mr-sm-2" name="search" style="width: 300px" type="search" placeholder="Search for any question" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</nav>
<br><br><br><br>
		<div class="container">
			<form class="form-horizontal" role="form" action="addarticle.php" method="POST">
				<div class="card">
					<div class="card-header">
						<input type="text" class="form-control" placeholder="Provide a topic for your article" name="topic"/>
					</div>
					<div class="card-body">
						<textarea class="form-control" rows="5" cols = 50 id="comment" name="text" placeholder="Write your article here"></textarea>
						<br>
						<input type="submit" name="Submit" value="Post Article" />
					</div>
				</form>
			</div>
		</div>
	</body>
</html>