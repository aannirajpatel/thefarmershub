<?php
require("../includes/auth.php");
include("../includes/db.php");
if(!isset($_REQUEST['articleid'])){
	header('../dashboard/dashboard.php');
}
$articleid = $_REQUEST['articleid'];
$qry = "SELECT * FROM article WHERE articleid=$articleid";
$res = mysqli_query($con,$qry) or die(mysqli_error());
$row = mysqli_fetch_array($res);
$topic = $row['topic'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<style type="text/css">
		body, html {
		height: 100%;
		}
		.bg {
		background-image: linear-gradient(to right bottom, #051937, #004872, #007d9e, #00b5b1, #12eba9);
		/*background-image: linear-gradient(to right top, #ff6600, #ff3f6c, #f052b7, #a376e6, #128deb);*/
		height: 100%;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		}
		</style>
		<title>Write comment</title>
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
        <a class="nav-link" href="#">Statistics</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../logout/logout.php">Logout</a>
      </li>
    </ul>
  </div>
    <form class="form-inline my-2 my-lg-0" style="float:right;" action="../forum/searcharticles.php" method="get">
      <input class="form-control mr-sm-2" name="search" style="width: 300px" type="search" placeholder="Search for any article" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</nav>
<br><br><br><br>
		<div class="container">
				<div class="card">
					<div class="card-header">Comment on the article on topic "<?php echo $topic;?>"</div>
					<div class="card-body">
						<form class="form-horizontal" action="addcomment.php" method="POST">
							<textarea class="form-control" rows="5" cols = 50 id="comment" name="comment" placeholder="Write your comment here"></textarea><br>
							<input type="hidden" name="articleid" <?php echo 'value="'.$articleid.'"';?> />
						<input type="submit" value="Submit" />
						</form>
					</div>
			</div>
		</div>
	</body>
</html>