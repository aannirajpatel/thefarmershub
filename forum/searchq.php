<?php
session_start();
if(!isset($_REQUEST['search'])){
header('Location: ../dashboard/dashboard.php');
}
require("../includes/db.php");
$query = $_REQUEST['search'];
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
        background-image: linear-gradient(to right top, #ff6600, #ff3f6c, #f052b7, #a376e6, #128deb);
        height: fill;
        min-height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
    </style>
    <title>Viewing Question
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js">
    </script>
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
		</ul>
	  </div>
		<form class="form-inline my-2 my-lg-0" style="float:right;" action="searchq.php" method="get">
		  <input class="form-control mr-sm-2" style="width: 300px" name="search" type="search" placeholder="Search for any question" aria-label="Search">
		  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form>
	</nav>
	<br>
    <br>
    <br>
    <div class="container">
      <div class="card">
        <div class = "card-header">
          Search Results for <i><?php echo $query?></i>
        </div>
        <div class = "card-body">
      			<table class="table">
      				<thead><th>User</th><th>Question</th><th>Time Posted</th><th>Answers</th><th>Upvotes</th><th>Downvotes</th></thead>
      				<?php
      				  $raw_results = mysqli_query($con,"SELECT * FROM question WHERE (LOWER(qtext) LIKE '%".strtolower($query)."%') ORDER BY qupcount-qdowncount DESC") or die(mysql_error());
					  if(!$raw_results){
      				?>
      				  <tr><td>---</td><td>No results to show...</td><td>---</td><td>-</td><td>-</td>
      				<?php
      				  }
      				  else{
      				  	while($row = mysqli_fetch_assoc($raw_results)){
							    $qryans = "SELECT count(*) AS cans FROM answer WHERE qno=".$row['qno'];
                  $res = mysqli_query($con, $qryans);
                  $rowans = mysqli_fetch_array($res);
                  $qryname = "SELECT username FROM account WHERE uid=".$row['uid'];
                  $resname = mysqli_query($con, $qryname);
                  $nameans = mysqli_fetch_array($resname);
                  $name=$nameans['username'];
      						echo "
      							<tr>
      								<td>".$name."</td>
      								<td>".'<a href="viewq.php?q='.$row['qno'].'">'.$row['qtext']."</a></td>
      								<td>".$row['qtimestamp']."</td>
                      <td style='color: blue;'>".$rowans['cans']."</td>
      								<td style='color: green;'>".$row['qupcount']."</td>
      								<td style='color: red;'>".$row['qdowncount']."</td>
      							</tr>";
      				  	}
      				  }
      				?>
 				</table>
 				</div>
    </div>
    </div>
  </body>
</html>