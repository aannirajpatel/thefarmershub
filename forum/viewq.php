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
$udqry = "SELECT * FROM qupdown WHERE qno=$qno AND uid=$uid";
$udres = mysqli_query($con, $udqry);
	if($udres!=false && mysqli_num_rows($udres)>0){
		$udrow = mysqli_fetch_assoc($udres);
		if($udrow['ud']==1){
			$uvs = '<i id="usvg" data-vi="angle-top" data-vi-size="30" style="color: green;"></i>';
			$dvs = '<i id="dsvg" data-vi="angle-bottom" data-vi-size="30" style="color: black;"></i>';
			$udsituation="Upvoted";
		}
		else if($udrow['ud']==0){
			$uvs = '<i id="usvg" data-vi="angle-top" data-vi-size="30" style="color: black;"></i>';
			$dvs = '<i id="dsvg" data-vi="angle-bottom" data-vi-size="30" style="color: red;"></i>';
			$udsituation="Downvoted";
		}
	}
	else{
		$uvs = '<i id="usvg" data-vi="angle-top" data-vi-size="30" style="color: black;"></i>';
		$dvs = '<i id="dsvg" data-vi="angle-bottom" data-vi-size="30" style="color: black;"></i>';
		$udsituation = "Resetted";
	}
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
    <script src="https://cdn.jsdelivr.net/npm/vivid-icons@1.0.9" type="text/javascript">
    </script>
    <script type="text/javascript">
    	function aupvote(q,u){
    		var auddata = "uid="+toString(u)+"&qno="+toString(q);
    		$.ajax({
			      type: "POST",
			      url: "aupdown.php",
			      data: auddata + "&vote=Upvote",
			      success: function(data) {
			       if(data=="Resetted"){
		 	        	$("#btnup"+toString(u)+toString(q)).attr("style","background: white;");
			        	$("#btndown"+toString(u)+toString(q)).attr("style","background: white;");
			        }
			        if(data=="Upvoted"){
		 	        	$("#btnup"+toString(u)+toString(q)).attr("style","background: green;");
			        	$("#btndown"+toString(u)+toString(q)).attr("style","background: white;");
			        }
			        console.log(data);
			      }
			    });
    	};
    	var data = "uid=" + <?php echo '"'.$uid.'"' ?> + "&q=" + <?php echo '"'.$qno.'"' ?> ;
    	var udsituation = <?php echo '"'.$udsituation.'"';?>;
    	console.log(udsituation);
		$("document").ready(function(){
			if(udsituation=="Upvoted"){
				console.log("Upvoted style");
				$("#upvote").attr("style", "background: green;");
			}
			else if(udsituation=="Downvoted"){
				console.log("Downvoted style");
				$("#downvote").attr("style", "background: red;");
			}
			else{
				console.log("Resetted style");
				$("#upvote").attr("style", "background: white;");
				$("#downvote").attr("style", "background: white;");	
			}
			$("#upvote").click(
				function(){
				console.log("Upvote");
			    $.ajax({
			      type: "POST",
			      url: "qupdown.php",
			      data: data + "&vote=Upvote",
			      success: function(data) {
			       if(data=="Resetted"){
		 	        	$("#upvote").attr("style","background: white;");
			        	$("#downvote").attr("style","background: white;");
			        }
			        if(data=="Upvoted"){
			        	$("#upvote").attr("style","background: green;");
			        	$("#downvote").attr("style","background: white;");
			        }
			        console.log(data);
			      }
			    });
			  });
			$("#downvote").click(
				function(){
				console.log("Downvote");
			    $.ajax({
			      type: "POST",
			      url: "qupdown.php",
			      data: data + "&vote=Downvote",
			      success: function(data) {
			        if(data=="Resetted"){
			        	$("#upvote").attr("style","background: white;");
			        	$("#downvote").attr("style","background: white;");
			        }
			        if(data=="Downvoted"){
			        	$("#upvote").attr("style","background: white;");
			        	$("#downvote").attr("style","background: red;");
			        }
			        console.log(data);
			      }
			    });
			  });
		});
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
		  	<li class="nav-item">
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
            <span style="float: left;">
			<button class="btn btn-default"><a style="text-decoration: none;" href= <?php echo "createanswer.php?q=".$qno; ?>><i data-vi="chat" data-vi-size="30"></i></a></button>
            <span id="udformcover">
			<button class="btn btn-default" id="upvote"><?php echo $uvs ?></button>
			<button class="btn btn-default" id="downvote"><?php echo $dvs ?></button>
			</span>
			</span>
			<br>
          <?php
          	}
          ?>
      	<br>
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
      								<td style='color: green;'>".$row['aupcount'].'<button class="btn btn-default" id="btnup'.$row['uid'].$row['qno'].'"><span onclick="aupvote('.$row['qno'].','.$row['uid'].')" data-vi="angle-top" data-vi-size="20"></span></button>'."</td>
      								<td style='color: red;'>".$row['adowncount'].'<button class="btn btn-default" id="btndown'.$row['uid'].$row['qno'].'"><span onclick="adownvote('.$row['qno'].','.$row['uid'].')" data-vi="angle-bottom" data-vi-size="20"></span></button>'."</td>
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