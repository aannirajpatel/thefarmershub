<?php
include("../includes/db.php");
include("../includes/auth.php"); 
$uid = $_SESSION['uid'];
$aid = $_REQUEST['aid'];
$qry = "SELECT * FROM aupdown WHERE aid = $aid AND uid = $uid";
$res = mysqli_query($con, $qry) or die(mysqli_error($con));
if($_REQUEST['vote']=="Upvote"){
	if($res==false || mysqli_num_rows($res)==0){
		$qry = "INSERT INTO aupdown(aid, uid, ud) VALUES($aid, $uid, 1)";
		$res = mysqli_query($con, $qry) or die(mysqli_error($con));
		$qry = "UPDATE answer SET aupcount=aupcount+1 WHERE aid = $aid";
		$res = mysqli_query($con, $qry) or die(mysqli_error($con));
		echo "Upvoted";
	}
	else{
		$row = mysqli_fetch_array($res);
		if($row['ud']==0){
			$qry = "UPDATE aupdown SET ud=1 WHERE aid = $aid AND uid = $uid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			$qry = "UPDATE answer SET aupcount=aupcount+1 WHERE aid = $aid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			$qry = "UPDATE answer SET adowncount=adowncount-1 WHERE aid = $aid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			echo "Upvoted";
		}
		else{
			$qry = "DELETE FROM aupdown WHERE aid= $aid AND uid = $uid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			if($row['ud']==1){
				$qry = "UPDATE answer SET aupcount=aupcount-1 WHERE aid=$aid";
				$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			}
			else if($row['ud']==0){
				$qry = "UPDATE answer SET adowncount=adowncount-1 WHERE aid = $aid";
				$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			}
			echo "Resetted";
		}
	}
}
if($_REQUEST['vote']=="Downvote"){
	if($res==false || mysqli_num_rows($res)==0){
		$qry = "INSERT INTO aupdown(aid, uid, ud) VALUES($aid, $uid, 0)";
		$res = mysqli_query($con, $qry) or die(mysqli_error($con));
		$qry = "UPDATE answer SET adowncount=adowncount+1 WHERE aid = $aid";
		$res = mysqli_query($con, $qry) or die(mysqli_error($con));
		echo "Downvoted";
	}
	else{
		$row = mysqli_fetch_array($res);
		if($row['ud']==1){
			$qry = "UPDATE aupdown SET ud=0 WHERE aid = $aid AND uid = $uid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			$qry = "UPDATE answer SET adowncount=adowncount+1 WHERE aid = $aid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			$qry = "UPDATE answer SET aupcount=aupcount-1 WHERE aid = $aid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			echo "Downvoted";
		}
		else{
			$qry = "DELETE FROM aupdown WHERE aid= $aid AND uid = $uid";
			$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			if($row['ud']==1){
				$qry = "UPDATE answer SET aupcount=aupcount-1 WHERE aid=$aid";
				$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			}
			else if($row['ud']==0){
				$qry = "UPDATE answer SET adowncount=adowncount-1 WHERE aid = $aid";
				$res = mysqli_query($con, $qry) or die(mysqli_error($con));
			}
			echo "Resetted";
		}
	}
}
?>