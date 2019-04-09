<?php
session_start();
require("../includes/db.php");

function statTimes(){
	require("../includes/db.php");
	$qry = "SELECT stimestamp FROM statistics";
	$res = mysqli_query($con, $qry);
	$strout = "";
	while($row = mysqli_fetch_assoc($res)){
		if($strout!=""){
			$strout=$strout.',"'.$row['stimestamp'].'"';
		}
		else{
			$strout= '"'.$row['stimestamp'].'"';
		}
	}
	echo $strout;
}
function HIData($a, $b){
	require("../includes/db.php");
	$qry = "SELECT $a, $b FROM statistics";
	$res = mysqli_query($con, $qry);
	$strout = "";
	while($row = mysqli_fetch_assoc($res)){
		if($strout!=""){
			$strout=$strout.",".($row[$a]/$row[$b]);
		}
		else{
			$strout = $row[$a]/$row[$b];
		}
	}
	echo $strout;
}
function overallHIData(){
	require("../includes/db.php");
	$qry = "SELECT (totalanswers-apc+totalcomments-cpc+totalarticles-arpc+totalquestions-qpc) AS totalneg,
	apc+cpc+arpc+qpc AS totalpos FROM statistics ORDER BY stimestamp DESC LIMIT 1";
	$res = mysqli_query($con, $qry) or die(mysqli_error($con));
	$row = mysqli_fetch_assoc($res);
	echo $row['totalpos'].",".$row['totalneg'];
}
function totalPostsDistribution(){
	require("../includes/db.php");
	$qry = "SELECT totalanswers-apc AS anc, totalcomments-cpc AS cnc, totalarticles-arpc AS arnc, totalquestions-qpc AS qnc,
	apc,cpc,arpc,qpc FROM statistics ORDER BY stimestamp DESC LIMIT 1";
	$res = mysqli_query($con, $qry);
	$row = mysqli_fetch_array($res);
	$i=0;
	$strout = "";
	for($i=0;$i<8;$i++){
		if($i==0){
			$strout=$row[$i];
		}
		else{
			$strout = $strout.",".$row[$i];
		}
	}
	echo $strout;
}
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
      background-image: linear-gradient(to right bottom, #051937, #004872, #007d9e, #00b5b1, #12eba9);
      height: fill;
      min-height: 100%;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
   </style>
  <title>Statistics</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script src="https://codepen.io/anon/pen/aWapBE.js"></script>
  <script type="text/javascript">
  	$(document).ready(function(){
	    var ct1 = document.getElementById('HIChart').getContext('2d');
  		ct1.height = 450;
	    var chart1 = new Chart(ct1, {
	        type: 'line',
  			data: {
    			labels: [<?php statTimes();?>],
    			datasets: [{ 
	        		data: [<?php HIData('apc','totalanswers'); ?>],
        			label: "Answers Happiness Index",
    			    borderColor: "#3e95cd",
        			fill: false
      			},
      			{ 
        data: [<?php HIData('qpc','totalquestions'); ?>],
        label: "Questions Happiness Index",
        borderColor: "#8e5ea2",
        fill: false
      }, { 
        data: [<?php HIData('arpc','totalarticles'); ?>],
        label: "Articles Happiness Index",
        borderColor: "#3cba9f",
        fill: false
      }, { 
        data: [<?php HIData('cpc','totalcomments'); ?>],
        label: "Comments Happiness Index",
        borderColor: "#e8c3b9",
        fill: false
      }
    ]
  },
  options: {
  	scales: {
        yAxes: [{
            display: true,
            ticks: {
                suggestedMin: 0,
                beginAtZero: true
            }
        }]
    },
    title: {
      display: true,
      text: 'Happiness Index values per category'
    }
  }
});

	    var ct2 = document.getElementById('overallHIChart').getContext('2d');
	    var chart2 = new Chart(ct2, {
	        type: 'doughnut',
	        data: {
	            labels: ['Total Positive Posts','Total Negative Posts'],
	            datasets: [{
	                data: [<?php overallHIData();?>],
	                backgroundColor: ["#3e95cd", "#8e5ea2"],
	            }]
	        },
	        options: {}
	    });

	    var ct3 = document.getElementById('totalPostsDistribution').getContext('2d');
	    var chart3 = new Chart(ct3, {
	        type: 'pie',
	        data: {
	            labels: ['Positive Answers','Negative Answers','Positive Questions', 'Negative Questions','Positive Articles','Negative Articles', 'Positive Comments', 'Negative Comments'],
	            datasets: [{
	                data: [<?php totalPostsDistribution();?>],
	                backgroundColor: palette('tol', 8).map(function(hex) {return '#' + hex;}),
	            }]
	        },
	        options: {}
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
  	<?php if(isset($_SESSION['uid'])){ ?>
      <li class="nav-item">
        <a class="nav-link" href="../dashboard/dashboard.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../articles/articles.php">Articles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../forum/forum.php">Forums</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="../statistics/statistics.php">Statistics</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../logout/logout.php">Logout</a>
      </li>
    <?php } else{ ?>
		<li class="nav-item">
	        <a class="nav-link" href="../login/login.php">Login
	        </a>
      	</li>
      	<li class="nav-item">
	        <a class="nav-link" href="../signup/signup.php">Sign Up
	        </a>
      	</li>
	    <li class="nav-item">
	      <a class="nav-link" href="../articles/articles.php">Articles
	      </a>
	    </li>
      	<li class="nav-item">
          <a class="nav-link" href="../forum/forum.php">Forums
          </a>
      	</li>
        <li class="nav-item">
          <a class="nav-link active" href="../statistics/statistics.php">Statistics
          </a>
        </li>	
    <?php } ?>
    </ul>
  </div>
    <form class="form-inline my-2 my-lg-0" style="float:right;" action="../forum/searchq.php" method="get">
      <input class="form-control mr-sm-2" name="search" style="width: 300px" type="search" placeholder="Search for any question" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</nav>
<br><br><br><br>
<div class="container">
	<div class="card">
	  <div class="card-header"><h3>Statistics</h3></div>
	  <div class="card-body">
	  	<canvas id="HIChart" width="800" height="450"></canvas>
	  	<br><br>
	  	<canvas id="overallHIChart" width="800" height="450"></canvas>
	  	<br><br>
	  	<canvas id="totalPostsDistribution" width="800" height="450"></canvas>
	  	<br><br>
	  </div>
	</div>
</div>
</div>
</body>
</html> 