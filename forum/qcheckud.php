<?php
require('../includes/auth.php');
require('../includes/db.php');

if(!isset($_POST['q'])){
	echo "InvalidRequest";
	die();
}

$qno = $_POST['q'];
$uid = $_SESSION['uid'];
$query = "SELECT * FROM qupdown WHERE qno = $qno AND uid = $uid";
$result = mysqli_query($con, $query);
if(!$result || mysqli_num_rows($result) == 0){
	echo "None";
}
else{
	$row = mysqli_fetch_assoc($result);

	$ud = $row['ud'];
	if($ud == 1){
		echo "Upvoted";
	}
	else{
		echo "Downvoted";
	}
}