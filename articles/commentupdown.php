<?php
include("../includes/db.php");
include("../includes/auth.php"); 
$uid = $_SESSION['uid'];
$commentid = $_REQUEST['commentid'];
$qry = "SELECT * FROM commentupdown WHERE commentid = $commentid AND uid = $uid";
$res = mysqli_query($con, $qry) or die(mysqli_error($con));
if($_REQUEST['vote']=="Upvote"){
	if($res==false || mysqli_num_rows($res)==0){
		$qry = "INSERT INTO commentupdown(commentid, uid, ud) VALUES($commentid, $uid, 1)";
		$res = mysqli_query($con, $qry) or die(mysqli_error($con));
		$qry = "UPDATE comment SET cupcount=cupcount+1 WHERE commentid = $commentid";
		$res = mysqli_query($con, $qry) or die(mysqli_error($con));
		echo "Upvoted";
	}
	else{
		$row = mysqli_fetch_array($res);
		if($row['ud']==0){
			$qry = "UPDATE commentupdown SET ud=1 WHERE commentid = $commentid AND uid = $uid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			$qry = "UPDATE comment SET cupcount=cupcount+1 WHERE commentid = $commentid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			$qry = "UPDATE comment SET cdowncount=cdowncount-1 WHERE commentid = $commentid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			echo "Upvoted";
		}
		else{
			$qry = "DELETE FROM commentupdown WHERE commentid= $commentid AND uid = $uid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			if($row['ud']==1){
				$qry = "UPDATE comment SET cupcount=cupcount-1 WHERE commentid=$commentid";
				$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			}
			else if($row['ud']==0){
				$qry = "UPDATE comment SET cdowncount=cdowncount-1 WHERE commentid = $commentid";
				$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			}
			echo "Resetted";
		}
	}
}
if($_REQUEST['vote']=="Downvote"){
	if($res==false || mysqli_num_rows($res)==0){
		$qry = "INSERT INTO commentupdown(commentid, uid, ud) VALUES($commentid, $uid, 0)";
		$res = mysqli_query($con, $qry) or die(mysqli_error($con));
		$qry = "UPDATE comment SET cdowncount=cdowncount+1 WHERE commentid = $commentid";
		$res = mysqli_query($con, $qry) or die(mysqli_error($con));
		echo "Downvoted";
	}
	else{
		$row = mysqli_fetch_array($res);
		if($row['ud']==1){
			$qry = "UPDATE commentupdown SET ud=0 WHERE commentid = $commentid AND uid = $uid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			$qry = "UPDATE comment SET cdowncount=cdowncount+1 WHERE commentid = $commentid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			$qry = "UPDATE comment SET cupcount=cupcount-1 WHERE commentid = $commentid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			echo "Downvoted";
		}
		else{
			$qry = "DELETE FROM commentupdown WHERE commentid= $commentid AND uid = $uid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			if($row['ud']==1){
				$qry = "UPDATE comment SET cupcount=cupcount-1 WHERE commentid=$commentid";
				$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			}
			else if($row['ud']==0){
				$qry = "UPDATE comment SET cdowncount=cdowncount-1 WHERE commentid = $commentid";
				$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			}
			echo "Resetted";
		}
	}
}
?>