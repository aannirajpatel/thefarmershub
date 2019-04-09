<?php
require('../includes/auth.php');
require('../includes/db.php');

if(!isset($_POST['articleid'])){
	echo "InvalidRequest";
	die();
}

$articleid = $_POST['articleid'];
$uid = $_SESSION['uid'];
$query = "SELECT * FROM articleupdown WHERE articleid = $articleid AND uid = $uid";
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