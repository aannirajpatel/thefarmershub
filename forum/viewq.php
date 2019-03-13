<?php
session_start();

if(!isset($_REQUEST['q'])){
header('Location: ../dashboard/dashboard.php');
}

$qno = $_REQUEST['q'];

$canAnswer = 0;
if(isset($_SESSION["uid"])){
$canAnswer=1;
$uid = $_SESSION['uid'];
}
else{
$canAnswer=0;
}
require("../includes/db.php");

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
        background-image: linear-gradient(to right bottom, #051937, #004d7a, #008793, #00bf72, #a8eb12);
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
		$("#upform").submit(function(event){
	    event.preventDefault();
	    if (request) {
	        request.abort();
	    }
	    var $form = $(this);
	    var $inputs = $form.find("input, select, button, textarea");
	    var serializedData = $form.serialize()+ <?php echo '"&uid=$uid";';
	    $inputs.prop("disabled", true);
	    request = $.ajax({
	        url: "/qupdown.php",
	        type: "post",
	        data: serializedData
	    });
	    request.done(function (response, textStatus, jqXHR){
	        $("#updown").text("Upvoted")
	    });
	    request.fail(function (jqXHR, textStatus, errorThrown){
	        console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
	    });

	    // Callback handler that will be called regardless
	    // if the request failed or succeeded
	    request.always(function () {
	        // Reenable the inputs
	        $inputs.prop("disabled", false);
	    });

		});
    </script>
  </head>
  <body class="bg">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <a class="navbar-brand" href="#">The Farmer's Hub
      </a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../dashboard/dashboard.php">Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Articles
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../forum/forum.php">Forums
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Statistics
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../logout/logout.php">Logout
          </a>
        </li>
      </ul>
    </nav>
    <br>
    <br>
    <div class="container">
      <div class="card">
        <div class = "card-header">
          Question by 
          <?php
          	$qry = "SELECT * FROM account WHERE uid=$postingUser";
          	$res = mysqli_query($con, $qry);
          	$row = mysqli_fetch_assoc($res);
          	echo $row['fname']." ".$row['lname'];
          ?>
      	  
        </div>
        <div class = "card-body">
          <?php echo $qtext;
          	if($canAnswer==1){
          ?>
          <br>
          <p class="text-right"><a href= <?php echo "createanswer.php?q=".$qno; ?>>Answer this question
          	<form style="display:inline;" action="" method="POST"><input type="submit" id="uv" value="Upvote" name="press"/></form>
          	<form style="display: inline;"><input type="submit" id="dislike" value="Downvote" name="press"/></form>
          </a></p>
          <?php
          	}
          ?>
      	<br>
      			<table class="table">
      				<thead><th>User</th><th>Answer</th><th>Timestamp</th><th>Upvotes</th><th>Downvotes</th></thead>
      				<?php
      				  $qry = "SELECT * FROM answer WHERE qno=$qno ORDER BY (aupvotes-adownvotes) DESC atimestamp DESC";
      				  $res = mysqli_query($con, $qry);
      				  if(!$res){
      				?>
      				  <tr><td>---</td><td>No answers yet...</td><td>---</td><td>-</td><td>-</td>
      				<?php
      				  }
      				  else{
      				  	while($row = mysqli_fetch_assoc($res)){
      						echo "
      							<tr>
      								<td>".$row['uid']."</td>
      								<td>".$row['atext']."</td>
      								<td>".$row['atimestamp']."</td>
      								<td>style='color: green;'>".$row['aupcount']."</td>
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