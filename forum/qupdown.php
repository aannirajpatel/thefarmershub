<?php
require("../includes/db.php");
$uid=$_REQUEST['uid'];
if($_REQUEST['vote']=="Upvote"){
	$qno = $_REQUEST['qno'];
	$qry = "SELECT FROM qupdown WHERE uid=$uid AND qno=$qno AND ud=1";
	$res = mysqli_query($con, $qry);
	if(!$res){
		$qry = "INSERT INTO qupdown(uid, qno, ud) VALUES($uid, $qno, 1)";
		$res = mysqli_query($con, $qry);
		$qry = "UPDATE question SET qupcount=qupcount+1 WHERE qno=$qno";
		$res = mysqli_query($con, $qry);
	}
	echo 'Upvoted';
}
else if($_REQUEST['vote']=="Downvote"){
	$qno = $_REQUEST['qno'];
	$qry = "SELECT FROM qupdown WHERE uid=$uid AND qno=$qno AND ud=0";
	$res = mysqli_query($con, $qry);
	if(!$res){
		$qry = "INSERT INTO qupdown(uid, qno, ud) VALUES($uid, $qno, 0)";
		$res = mysqli_query($con, $qry);
		$qry = "UPDATE question SET qupcount=qupcount+1 WHERE qno=$qno";
		$res = mysqli_query($con, $qry);
	}
	echo 'Downvoted';
}
else if($_REQUEST['vote']=="Reset"){
	$qno = $_REQUEST['qno'];
	$qry = "SELECT FROM qupdown WHERE uid=$uid AND qno=$qno AND ud=1";
	$res = mysqli_query($con, $qry);
	if(!$res){
		$qry = "INSERT INTO qupdown(uid, qno, ud) VALUES($uid, $qno, 1)";
		$res = mysqli_query($con, $qry);
		$qry = "UPDATE question SET qupcount=qupcount+1 WHERE qno=$qno";
		$res = mysqli_query($con, $qry);
	}
	echo 'Resetted';
}