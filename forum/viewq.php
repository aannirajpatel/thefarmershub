<?php
session_start();
//require('../includes/auth.php');
if(!isset($_REQUEST['q'])){
header('Location: ../forum/forum.php');
}

require("../includes/db.php");
$qno = $_REQUEST['q'];

$canAnswer = 0;
if(isset($_SESSION["uid"])){
$canAnswer=1;
$uid = $_SESSION['uid'];
}
else{
$canAnswer=0;
}

$qry = "SELECT qtext,uid FROM question WHERE qno = $qno";
$res = mysqli_query($con, $qry) or die(mysqli_error($con));
if(mysqli_num_rows($res) == 0){
header('Location: ../error404.php');
}

$row = mysqli_fetch_array($res);
$qtext = $row['qtext'];
$postingUser = $row['uid'];

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
        /*background-image: linear-gradient(to right bottom, #051937, #004d7a, #008793, #00bf72, #a8eb12);*/
        height: 100%;
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
    <script type="text/javascript">
		var request;
		x = function(event){
			console.log("hi");
	    event.preventDefault();
	    if (request) {
	        request.abort();
	    }
	    var $form = $(this);
	    var $inputs = $form.find("input, select, button, textarea");
	    var serializedData = $form.serialize();
	    $inputs.prop("disabled", true);
	    request = $.ajax({
	        url: "./qupdown.php",
	        type: "post",
	        data: serializedData
	    });
	    request.done(function (response, textStatus, jqXHR){
	        $("#udformcover").innerHTML=response;
	    });
	    request.fail(function (jqXHR, textStatus, errorThrown){
	        console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
	    });
	    request.always(function () {
	        $inputs.prop("disabled", false);
	    });
		};
    $("#uform").submit(x);
    $("#dform").submit(x);
    $("#rform").submit(x);
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
		  
      <?php if($canAnswer){ ?>
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
    <?php
	}
	else{
    ?>
          <li class="nav-item">
			<a class="nav-link" href="../login/login.php">Login</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="../signup/signup.php">Sign Up</a>
		  </li>
		  	<li class="nav-item active">
			<a class="nav-link" href="#">Articles</a>
		  </li>
		  <li class="nav-item active">
			<a class="nav-link" href="../forum/forum.php">Forums</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="#">Statistics</a>
		  </li>	
<?php } ?>

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
          Question by <i>
          <?php
          	$qry = "SELECT * FROM account WHERE uid=$postingUser";
          	$res = mysqli_query($con, $qry);
          	$row = mysqli_fetch_assoc($res);
          	echo $row['fname']." ".$row['lname'];
          ?>
      	  </i>
        </div>
        <div class = "card-body">
          <?php echo $qtext;
          	if($canAnswer==1){
          ?>
          <br>
            <span style="float:right">
			<button class="btn-primary"><a style="text-decoration: none; color: white;" href= <?php echo "createanswer.php?q=".$qno; ?>>Answer this question</a></button>
            <span id="udformcover">
			<form style="display:inline;" id="uform">
        <input class="btn-success" type="submit" id="uv" value="Upvote" name="vote"/>
        <input type="hidden" name="uid" <?php echo 'value="'.$uid.'"'; ?>/>
      </form>
      <form style="display: inline;" id="dform">
        <input class="btn-danger" type="submit" id="dv" value="Downvote" name="vote"/>
        <input type="hidden" name="uid" <?php echo 'value="'.$uid.'"'; ?>/>
        </form>
      <form style="display: inline;" id="rform">
        <input class="btn-warning" type="submit" id="rs" value="Reset" name="vote"/>
        <input type="hidden" name="uid" <?php echo 'value="'.$uid.'"'; ?>/>
      </form>
      </span>
			</span>
			<br>
          <?php
          	}
          ?>
      	<br><br>
      			<table class="table">
      				<thead><th>User</th><th>Answer</th><th>Timestamp</th><th>Upvotes</th><th>Downvotes</th></thead>
      				<?php
      				  $qry = "SELECT * FROM answer WHERE qno=$qno ORDER BY (aupcount-adowncount) DESC, atimestamp DESC";
      				  $res = mysqli_query($con, $qry) or die(mysqli_error($con));
      				  if(!$res){
      				?>
      				  <tr><td>---</td><td>No answers yet...</td><td>---</td><td>-</td><td>-</td>
      				<?php
      				  }
      				  else{
      				  	while($row = mysqli_fetch_assoc($res)){
                  $qry = "SELECT fname, lname FROM account WHERE uid=".$row['uid'];
                  $res2 = mysqli_query($con, $qry) or die(mysqli_error($con));
                  $r = mysqli_fetch_array($res2);
                  echo "<tr>
                      <td>".$r['fname']." ".$r['lname']."</td>
      								<td>".$row['atext']."</td>
      								<td>".$row['atimestamp']."</td>
      								<td style='color: green;'>".$row['aupcount']."</td>
      								<td style='color: red;'>".$row['adowncount']."</td>
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