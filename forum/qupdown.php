<?php
require("../includes/auth.php");
require("../includes/db.php");
$uid=$_SESSION['uid'];
if($_REQUEST['vote']=="u"){
	$qno = $_REQUEST['qno'];
	$qry = "SELECT FROM qupdown WHERE uid=$uid AND qno=$qno AND ud=1";
	$res = mysqli_query($con, $qry);
	if(!$res){
		$qry = "INSERT INTO qupdown(uid, qno, ud) VALUES($uid, $qno, 1)";
		$res = mysqli_query($con, $qry);
		$qry = "UPDATE question SET qupcount=qupcount+1 WHERE qno=$qno";
		$res = mysqli_query($con, $qry);
	}
}
else if($_REQUEST['vote']=="d"){
	$qno = $_REQUEST['qno'];
	$qry = "SELECT FROM qupdown WHERE uid=$uid AND qno=$qno AND ud=0";
	$res = mysqli_query($con, $qry);
	if(!$res){
		$qry = "INSERT INTO qupdown(uid, qno, ud) VALUES($uid, $qno, 0)";
		$res = mysqli_query($con, $qry);
		$qry = "UPDATE question SET qupcount=qupcount+1 WHERE qno=$qno";
		$res = mysqli_query($con, $qry);
	}
}
else if($_REQUEST['vote']=="r"){
	$qno = $_REQUEST['qno'];
	$qry = "SELECT FROM qupdown WHERE uid=$uid AND qno=$qno AND ud=1";
	$res = mysqli_query($con, $qry);
	if(!$res){
		$qry = "INSERT INTO qupdown(uid, qno, ud) VALUES($uid, $qno, 1)";
		$res = mysqli_query($con, $qry);
		$qry = "UPDATE question SET qupcount=qupcount+1 WHERE qno=$qno";
		$res = mysqli_query($con, $qry);
	}
}